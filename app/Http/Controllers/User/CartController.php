<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Vehicle;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->whereIn('status', ['pending'])
            ->get();

        foreach ($carts as $cart) {
            $vehicle = Vehicle::find($cart->vehicle_id);
            if ($vehicle) {
                // Stock di database sekarang sudah merefleksikan pengurangan saat checkout (paid/active)
                // Jadi available_stock murni adalah $vehicle->available_stock
                $cart->available_stock = max(0, (int) $vehicle->available_stock);
                $cart->is_stock_available = $cart->available_stock >= ($cart->quantity_vehicle ?? 1);
            } else {
                $cart->available_stock = 0;
                $cart->is_stock_available = false;
            }
        }

        $total = $carts->sum('subtotal');

        return view('user.cart.index', compact('carts', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        if ($vehicle->available_stock < 1) {
            return back()->with('error', 'Stok tidak mencukupi! Tersisa ' . $vehicle->available_stock . ' unit.');
        }

        // 1. Cek apakah user sudah meminjam jenis armada ini (mobil / motor) yang sedang dibooking/sewa (paid atau active)
        $hasActiveBookingOfType = Cart::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'active'])
            ->whereHas('vehicle', function ($q) use ($vehicle) {
                $q->where('vehicle_type', $vehicle->vehicle_type);
            })
            ->first();

        if ($hasActiveBookingOfType) {
            $typeLabel = $vehicle->vehicle_type === 'car' ? 'Mobil' : 'Motor';
            $statusText = $hasActiveBookingOfType->status === 'paid' ? 'sedang menunggu persetujuan manager' : 'sedang aktif Anda sewa';
            return back()->with('error', "Anda sudah memiliki 1 booking/sewa {$typeLabel} yang {$statusText}! Kebijakan rental: 1 akun maksimal meminjam 1 Mobil dan 1 Motor.");
        }

        // 2. Cek apakah di keranjang (pending) user sudah memasukkan jenis kendaraan ini (mobil / motor)
        $hasPendingCartOfType = Cart::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->whereHas('vehicle', function ($q) use ($vehicle) {
                $q->where('vehicle_type', $vehicle->vehicle_type);
            })
            ->first();

        if ($hasPendingCartOfType) {
            $typeLabel = $vehicle->vehicle_type === 'car' ? 'Mobil' : 'Motor';
            return redirect()->route('user.cart')->with('info', "Anda sudah memiliki 1 {$typeLabel} di dalam keranjang! Kebijakan rental: 1 akun maksimal meminjam 1 Mobil dan 1 Motor.");
        }

        // BOOKING CODE SEMENTARA (UNIQUE)
        do {
            $tempBookingCode = 'TEMP-' . strtoupper(Str::random(8));
        } while (Cart::where('booking_code', $tempBookingCode)->exists());

        Cart::create([
            'id' => Str::uuid(),
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->id,
            'quantity' => 1,
            'quantity_days' => 1,
            'quantity_vehicle' => 1,
            'period' => 'daily',
            'subtotal' => $vehicle->price_per_day,
            'rental_start_date' => now()->addDay(),
            'rental_end_date' => now()->addDays(2),
            'status' => 'pending',
            'booking_code' => $tempBookingCode,
            'pickup_location' => 'SMKN 21 Jakarta',
            'payment_deadline' => now()->addMinutes(30),
        ]);

        return redirect()->route('user.cart')->with('success', 'Kendaraan berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'pending')
            ->firstOrFail();

        $request->validate([
            'period' => 'required|in:daily,weekly',
            'quantity_days' => 'required|integer|min:1',
            'quantity_vehicle' => 'required|integer|min:1|max:1',
        ]);

        $vehicle = Vehicle::find($cart->vehicle_id);
        $period = $request->period;
        $quantityDays = (int) $request->quantity_days;
        $quantityVehicle = 1; // Ketentuan 1 akun hanya bisa meminjam 1 unit untuk tiap armada

        if ($period == 'daily' && $quantityDays > 7) {
            return back()->with('error', 'Untuk periode harian, maksimal 7 hari!');
        }

        if ($vehicle->available_stock < $quantityVehicle) {
            return back()->with('error', 'Stok tidak mencukupi! Tersedia ' . $vehicle->available_stock . ' unit.');
        }

        $totalDays = $period == 'weekly' ? 7 : $quantityDays;

        $cart->period = $period;
        $cart->quantity_days = $quantityDays;
        $cart->quantity_vehicle = $quantityVehicle;
        $cart->quantity = $totalDays * $quantityVehicle;
        $cart->subtotal = $vehicle->price_per_day * $totalDays * $quantityVehicle;
        $cart->rental_end_date = \Carbon\Carbon::parse($cart->rental_start_date)->addDays($totalDays);
        $cart->save();

        return redirect()->route('user.cart')->with('success', 'Keranjang berhasil diupdate!');
    }

    public function remove($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'pending')
            ->firstOrFail();

        $cart->delete();

        return redirect()->route('user.cart')->with('success', 'Kendaraan dihapus dari cart!');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong!');
        }

        // Cek validasi kuota 1 mobil 1 motor
        $carPendingCount = 0;
        $motorcyclePendingCount = 0;

        foreach ($carts as $cart) {
            $vehicle = Vehicle::find($cart->vehicle_id);
            if (!$vehicle || $vehicle->available_stock < ($cart->quantity_vehicle ?? 1)) {
                return redirect()->route('user.cart')->with('error', 'Stok kendaraan ' . ($vehicle->name ?? 'item') . ' tidak mencukupi!');
            }

            if ($vehicle->vehicle_type === 'car') {
                $carPendingCount += ($cart->quantity_vehicle ?? 1);
            } elseif ($vehicle->vehicle_type === 'motorcycle') {
                $motorcyclePendingCount += ($cart->quantity_vehicle ?? 1);
            }
        }

        if ($carPendingCount > 1 || $motorcyclePendingCount > 1) {
            return redirect()->route('user.cart')->with('error', 'Kebijakan rental: 1 akun hanya dapat meminjam maksimal 1 Mobil dan 1 Motor sekaligus.');
        }

        // Cek juga apakah user punya booking aktif di luar keranjang
        $userActiveCars = Cart::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'active'])
            ->whereHas('vehicle', fn($q) => $q->where('vehicle_type', 'car'))
            ->count();
        $userActiveMotors = Cart::where('user_id', auth()->id())
            ->whereIn('status', ['paid', 'active'])
            ->whereHas('vehicle', fn($q) => $q->where('vehicle_type', 'motorcycle'))
            ->count();

        if (($userActiveCars + $carPendingCount) > 1 || ($userActiveMotors + $motorcyclePendingCount) > 1) {
            return redirect()->route('user.cart')->with('error', 'Anda sudah memiliki peminjaman Mobil atau Motor yang aktif/menunggu persetujuan!');
        }

        $total = $carts->sum('subtotal');
        
        do {
            $bookingCode = 'BK-' . strtoupper(Str::random(8));
        } while (Cart::where('booking_code', $bookingCode)->exists());
        
        $paymentDeadline = now()->addMinutes(30);

        return view('user.cart.checkout', compact('carts', 'total', 'bookingCode', 'paymentDeadline'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,gopay,dana,ovo',
        ]);

        $carts = Cart::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong!');
        }

        // Cek stok kendaraan sebelum commit
        foreach ($carts as $cart) {
            $vehicle = Vehicle::find($cart->vehicle_id);
            if (!$vehicle || $vehicle->available_stock < ($cart->quantity_vehicle ?? 1)) {
                return redirect()->route('user.cart')->with('error', 'Stok kendaraan ' . ($vehicle->name ?? 'item') . ' habis!');
            }
        }

        $total = $carts->sum('subtotal');

        DB::beginTransaction();
        try {
            // STEP 1: SET SEMUA BOOKING_CODE CART INI KE NULL DULU
            foreach ($carts as $cart) {
                DB::table('carts')
                    ->where('id', $cart->id)
                    ->update([
                        'booking_code' => null,
                        'updated_at' => now(),
                    ]);
            }

            // STEP 2: BUAT PAYMENT RECORD
            $payment = Payment::create([
                'id' => Str::uuid(),
                'cart_id' => $carts->first()->id,
                'user_id' => auth()->id(),
                'amount' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'payment_code' => 'PAY-' . strtoupper(Str::random(10)),
                'paid_at' => null,
                'expired_at' => now()->addMinutes(30),
            ]);

            // STEP 3: UPDATE SETIAP CART DENGAN STATUS 'paid' (MENUNGGU PERSETUJUAN)
            // DAN KURANGI STOK ARMADA LANGSUNG SAAT CHECKOUT/SELESAI PEMBAYARAN INI
            $baseBookingCode = 'BK-' . strtoupper(Str::random(8));
            $counter = 1;
            $firstBookingCode = null;

            foreach ($carts as $cart) {
                if ($carts->count() == 1) {
                    $bookingCode = $baseBookingCode;
                } else {
                    $bookingCode = $baseBookingCode . '-' . $counter;
                }

                while (Cart::where('booking_code', $bookingCode)->exists()) {
                    $bookingCode = $baseBookingCode . '-' . strtoupper(Str::random(4));
                }

                if ($counter == 1) {
                    $firstBookingCode = $bookingCode;
                }

                DB::table('carts')
                    ->where('id', $cart->id)
                    ->update([
                        'status' => 'paid',
                        'booking_code' => $bookingCode,
                        'payment_deadline' => now()->addMinutes(30),
                        'updated_at' => now(),
                    ]);

                // 🔥 STOK ARMADA LANGSUNG BERKURANG SAAT CHECKOUT (STATUS PAID / MENUNGGU PERSETUJUAN)
                $vehicle = Vehicle::find($cart->vehicle_id);
                if ($vehicle) {
                    $qtyToDeduct = $cart->quantity_vehicle ?? 1;
                    $vehicle->available_stock = max(0, $vehicle->available_stock - $qtyToDeduct);
                    $vehicle->save();
                }
                
                $counter++;
            }

            DB::commit();

            return redirect()->route('user.payment.success', ['booking_code' => $firstBookingCode])
                ->with('success', 'Pembayaran berhasil dikirim! Menunggu konfirmasi manager armada.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($booking_code)
    {
        $carts = Cart::where('user_id', auth()->id())
            ->where('booking_code', $booking_code)
            ->where('status', 'paid')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Transaksi tidak ditemukan!');
        }

        $total = $carts->sum('subtotal');
        $pickupLocation = $carts->first()->pickup_location ?? 'SMKN 21 Jakarta';

        return view('user.cart.success', compact('carts', 'total', 'booking_code', 'pickupLocation'));
    }
}
