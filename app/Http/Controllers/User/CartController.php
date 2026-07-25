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
                $cartCount = Cart::where('vehicle_id', $cart->vehicle_id)
                    ->where('id', '!=', $cart->id)
                    ->whereIn('status', ['pending', 'paid'])
                    ->sum('quantity_vehicle');
                
                $cart->available_stock = $vehicle->available_stock - $cartCount;
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

        $cartCount = Cart::where('vehicle_id', $vehicle->id)
            ->whereIn('status', ['pending', 'paid'])
            ->sum('quantity_vehicle');
        
        $availableStock = $vehicle->available_stock - $cartCount;

        if ($availableStock < 1) {
            return back()->with('error', 'Stok tidak mencukupi! Tersisa ' . $availableStock . ' unit.');
        }

        $existingCart = Cart::where('user_id', auth()->id())
            ->where('vehicle_id', $vehicle->id)
            ->where('status', 'pending')
            ->first();

        if ($existingCart) {
            return redirect()->route('user.cart')->with('info', 'Kendaraan sudah ada di keranjang! Silahkan update jumlah.');
        }

        // 🔥 BOOKING CODE SEMENTARA
        $tempBookingCode = 'TEMP-' . strtoupper(Str::random(8));
        while (Cart::where('booking_code', $tempBookingCode)->exists()) {
            $tempBookingCode = 'TEMP-' . strtoupper(Str::random(8));
        }

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

        return redirect()->route('user.cart')->with('success', 'Kendaraan berhasil ditambahkan ke cart!');
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
            'quantity_vehicle' => 'required|integer|min:1',
        ]);

        $vehicle = Vehicle::find($cart->vehicle_id);
        $period = $request->period;
        $quantityDays = (int) $request->quantity_days;
        $quantityVehicle = (int) $request->quantity_vehicle;

        if ($period == 'daily' && $quantityDays > 7) {
            return back()->with('error', 'Untuk periode harian, maksimal 7 hari!');
        }

        $cartCountOthers = Cart::where('vehicle_id', $cart->vehicle_id)
            ->where('id', '!=', $cart->id)
            ->whereIn('status', ['pending', 'paid'])
            ->sum('quantity_vehicle');
        
        $availableStock = $vehicle->available_stock - $cartCountOthers;

        if ($quantityVehicle > $availableStock) {
            return back()->with('error', 'Stok tidak mencukupi! Tersedia ' . $availableStock . ' unit.');
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

        foreach ($carts as $cart) {
            $vehicle = Vehicle::find($cart->vehicle_id);
            $cartCount = Cart::where('vehicle_id', $cart->vehicle_id)
                ->whereIn('status', ['pending', 'paid'])
                ->sum('quantity_vehicle');
            $availableStock = $vehicle->available_stock - $cartCount;
            
            if ($availableStock < ($cart->quantity_vehicle ?? 1)) {
                return redirect()->route('user.cart')->with('error', 'Stok kendaraan ' . $vehicle->name . ' tidak mencukupi!');
            }
        }

        $total = $carts->sum('subtotal');
        
        // 🔥 BOOKING CODE UNIQUE UNTUK CHECKOUT
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

        $total = $carts->sum('subtotal');

        // Cek stok
        foreach ($carts as $cart) {
            $vehicle = Vehicle::find($cart->vehicle_id);
            $cartCount = Cart::where('vehicle_id', $cart->vehicle_id)
                ->whereIn('status', ['pending', 'paid'])
                ->sum('quantity_vehicle');
            $availableStock = $vehicle->available_stock - $cartCount;
            
            if ($availableStock < ($cart->quantity_vehicle ?? 1)) {
                return redirect()->route('user.cart')->with('error', 'Stok kendaraan ' . $vehicle->name . ' habis!');
            }
        }

        DB::beginTransaction();
        try {
            // 🔥 GENERATE BOOKING CODE UNIQUE
            do {
                $bookingCode = 'BK-' . strtoupper(Str::random(8));
            } while (Cart::where('booking_code', $bookingCode)->exists());

            // Buat payment record
            $payment = Payment::create([
                'id' => Str::uuid(),
                'cart_id' => $carts->first()->id,
                'user_id' => auth()->id(),
                'amount' => $total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'success',
                'payment_code' => 'PAY-' . strtoupper(Str::random(10)),
                'paid_at' => now(),
                'expired_at' => now()->addMinutes(30),
            ]);

            // Update semua cart
            foreach ($carts as $cart) {
                $cart->status = 'paid';
                $cart->booking_code = $bookingCode;
                $cart->payment_deadline = now()->addMinutes(30);
                $cart->save();

                $vehicle = Vehicle::find($cart->vehicle_id);
                $vehicle->available_stock -= ($cart->quantity_vehicle ?? 1);
                $vehicle->save();

                $payment->cart_id = $cart->id;
                $payment->save();
            }

            DB::commit();

            return redirect()->route('user.payment.success', ['booking_code' => $bookingCode])
                ->with('success', 'Pembayaran berhasil! Silakan menunggu konfirmasi pengiriman.');

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