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
            'package_type' => 'nullable|in:daily,weekly',
            'quantity_days' => 'nullable|integer|min:1|max:7',
        ]);

        $user = auth()->user();
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        // 0. Cek kelengkapan data user: nomor telepon, kota wilayah, dan alamat wajib ada
        if (empty($user->phone) || empty($user->location) || empty($user->address)) {
            return redirect()->route('user.profile.user')->with('error', 'Lengkapi Nomor Telepon, Kota Domisili, dan Detail Alamat Anda di menu profil terlebih dahulu sebelum menyewa!');
        }

        // 1. KUNCI WILAYAH: User hanya boleh booking kendaraan yang lokasinya sama dengan lokasi User
        if ($user->location !== $vehicle->location) {
            return back()->with('error', "Anda berada di {$user->location}. Silakan ganti lokasi Anda ke {$vehicle->location} di menu profil terlebih dahulu.");
        }

        if ($vehicle->available_stock < 1) {
            return back()->with('error', 'Stok tidak mencukupi! Tersisa ' . $vehicle->available_stock . ' unit.');
        }

        // 2. Cek apakah kendaraan yang sama persis sudah ada di keranjang pending
        $hasSameVehicleInCart = Cart::where('user_id', $user->id)
            ->where('status', 'pending')
            ->where('vehicle_id', $vehicle->id)
            ->first();

        if ($hasSameVehicleInCart) {
            return redirect()->route('user.cart')->with('info', "Kendaraan {$vehicle->name} sudah ada di keranjang Anda! Anda dapat mengatur durasi dan mencentangnya menggunakan checkbox saat checkout.");
        }

        // 3. Hitung harga paket harian / mingguan
        $packageType = $request->input('package_type', 'daily');
        if ($packageType === 'weekly') {
            $days = 7;
            $price = $vehicle->price_per_week > 0 ? $vehicle->price_per_week : ($vehicle->price_per_day * 7);
        } else {
            $days = min(7, max(1, (int) $request->input('quantity_days', 1)));
            $price = $vehicle->price_per_day * $days;
        }

        // BOOKING CODE SEMENTARA (UNIQUE)
        do {
            $tempBookingCode = 'TEMP-' . strtoupper(Str::random(8));
        } while (Cart::where('booking_code', $tempBookingCode)->exists());

        Cart::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'quantity' => $days,
            'quantity_days' => $days,
            'quantity_vehicle' => 1,
            'period' => $packageType,
            'package_type' => $packageType,
            'subtotal' => $price,
            'rental_start_date' => now()->addDay(),
            'rental_end_date' => now()->addDays($days + 1),
            'status' => 'pending',
            'booking_code' => $tempBookingCode,
            'pickup_location' => $user->address . ', ' . $user->location,
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
            'quantity_days' => 'nullable|integer|min:1|max:7',
        ]);

        $vehicle = Vehicle::find($cart->vehicle_id);
        $period = $request->period;
        $quantityVehicle = 1;

        if ($vehicle->available_stock < $quantityVehicle) {
            return back()->with('error', 'Stok tidak mencukupi! Tersedia ' . $vehicle->available_stock . ' unit.');
        }

        if ($period == 'weekly') {
            $totalDays = 7;
            $subtotal = $vehicle->price_per_week > 0 ? $vehicle->price_per_week : ($vehicle->price_per_day * 7);
        } else {
            $quantityDays = min(7, max(1, (int) $request->quantity_days));
            $totalDays = $quantityDays;
            $subtotal = $vehicle->price_per_day * $totalDays;
        }

        $cart->period = $period;
        $cart->package_type = $period;
        $cart->quantity_days = $totalDays;
        $cart->quantity_vehicle = $quantityVehicle;
        $cart->quantity = $totalDays;
        $cart->subtotal = $subtotal;
        $cart->rental_end_date = \Carbon\Carbon::parse($cart->rental_start_date)->addDays($totalDays);
        $cart->save();

        return redirect()->route('user.cart')->with('success', 'Keranjang berhasil diperbarui!');
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

    public function checkout(Request $request)
    {
        $user = auth()->user();

        // Ambil ID cart yang dipilih dari checkbox
        $rawSelected = $request->input('selected_carts', session('checkout_selected_carts', []));
        if (is_string($rawSelected)) {
            $selectedIds = array_filter(array_map('trim', explode(',', $rawSelected)));
        } else {
            $selectedIds = (array) $rawSelected;
        }

        $query = Cart::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('vehicle');

        if (!empty($selectedIds)) {
            $carts = $query->whereIn('id', $selectedIds)->get();
        } else {
            $allPending = $query->get();
            // Jika ada lebih dari 2 atau campuran lebih dari 1 mobil/motor, minta user pilih via checkbox
            $carCount = $allPending->where('vehicle.vehicle_type', 'car')->count();
            $motorCount = $allPending->where('vehicle.vehicle_type', 'motorcycle')->count();
            if ($carCount > 1 || $motorCount > 1 || $allPending->count() > 2) {
                return redirect()->route('user.cart')->with('error', 'Silakan pilih kendaraan yang ingin disewa menggunakan centang checkbox di keranjang (Maks. 1 Mobil dan 1 Motor).');
            }
            $carts = $allPending;
        }

        session(['checkout_selected_carts' => $carts->pluck('id')->toArray()]);

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong!');
        }

        // Cek kelengkapan profil
        if (empty($user->phone) || empty($user->location) || empty($user->address)) {
            return redirect()->route('user.profile.user')->with('error', 'Lengkapi No. HP, Kota Domisili, dan Detail Alamat Anda di menu profil sebelum melanjutkan checkout!');
        }

        // Cek validasi kuota 1 mobil 1 motor dan lokasi
        $carPendingCount = 0;
        $motorcyclePendingCount = 0;

        foreach ($carts as $cart) {
            $vehicle = $cart->vehicle;
            if (!$vehicle || $vehicle->available_stock < 1) {
                return redirect()->route('user.cart')->with('error', 'Stok kendaraan ' . ($vehicle->name ?? 'item') . ' tidak mencukupi!');
            }

            if ($user->location !== $vehicle->location) {
                return redirect()->route('user.cart')->with('error', "Anda berada di {$user->location}. Silakan ganti lokasi Anda ke {$vehicle->location} di menu profil terlebih dahulu.");
            }

            if ($vehicle->vehicle_type === 'car') {
                $carPendingCount++;
            } elseif ($vehicle->vehicle_type === 'motorcycle') {
                $motorcyclePendingCount++;
            }
        }

        if ($carPendingCount > 1 || $motorcyclePendingCount > 1) {
            return redirect()->route('user.cart')->with('error', 'Kebijakan rental: 1 akun hanya dapat meminjam maksimal 1 Mobil dan 1 Motor sekaligus.');
        }

        // Cek peminjaman aktif di luar keranjang
        $unfinalizedStatuses = ['paid', 'approved', 'active', 'pending_return', 'pending_payment'];
        $userActiveCars = Cart::where('user_id', $user->id)
            ->whereIn('status', $unfinalizedStatuses)
            ->whereHas('vehicle', fn($q) => $q->where('vehicle_type', 'car'))
            ->count();
        $userActiveMotors = Cart::where('user_id', $user->id)
            ->whereIn('status', $unfinalizedStatuses)
            ->whereHas('vehicle', fn($q) => $q->where('vehicle_type', 'motorcycle'))
            ->count();

        if (($userActiveCars + $carPendingCount) > 1 || ($userActiveMotors + $motorcyclePendingCount) > 1) {
            return redirect()->route('user.cart')->with('error', 'Anda sudah memiliki peminjaman Mobil atau Motor yang aktif / dalam proses!');
        }

        // KALKULASI ONGKIR OTOMATIS:
        // Motor: Rp 25.000, Mobil: Rp 50.000, Keduanya: Rp 75.000
        $deliveryFee = 0;
        if ($motorcyclePendingCount > 0) {
            $deliveryFee += 25000;
        }
        if ($carPendingCount > 0) {
            $deliveryFee += 50000;
        }

        $subtotal = $carts->sum('subtotal');
        $grandTotal = $subtotal + $deliveryFee;

        do {
            $bookingCode = 'BK-' . strtoupper(Str::random(8));
        } while (Cart::where('booking_code', $bookingCode)->exists());

        $paymentDeadline = now()->addMinutes(30);

        return view('user.cart.checkout', compact('carts', 'subtotal', 'deliveryFee', 'grandTotal', 'bookingCode', 'paymentDeadline', 'carPendingCount', 'motorcyclePendingCount'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,gopay,dana,ovo',
            'selected_carts' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Ambil cart yang terpilih
        $rawSelected = $request->input('selected_carts');
        if (!empty($rawSelected)) {
            $selectedIds = array_filter(array_map('trim', explode(',', $rawSelected)));
        } else {
            $selectedIds = session('checkout_selected_carts', []);
        }

        $query = Cart::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('vehicle');

        if (!empty($selectedIds)) {
            $carts = $query->whereIn('id', $selectedIds)->get();
        } else {
            $carts = $query->get();
        }

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong!');
        }

        // Cek stok kendaraan
        $carCount = 0;
        $motorCount = 0;
        foreach ($carts as $cart) {
            $vehicle = $cart->vehicle;
            if (!$vehicle || $vehicle->available_stock < 1) {
                return redirect()->route('user.cart')->with('error', 'Stok kendaraan ' . ($vehicle->name ?? 'item') . ' habis!');
            }
            if ($user->location !== $vehicle->location) {
                return redirect()->route('user.cart')->with('error', "Anda berada di {$user->location}. Silakan ganti lokasi Anda ke {$vehicle->location} di menu profil terlebih dahulu.");
            }
            if ($vehicle->vehicle_type === 'car') $carCount++;
            if ($vehicle->vehicle_type === 'motorcycle') $motorCount++;
        }

        // Hitung ongkir
        $totalDelivery = 0;
        if ($motorCount > 0) $totalDelivery += 25000;
        if ($carCount > 0) $totalDelivery += 50000;

        $subtotal = $carts->sum('subtotal');
        $grandTotal = $subtotal + $totalDelivery;

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
                'user_id' => $user->id,
                'amount' => $grandTotal,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'payment_code' => 'PAY-' . strtoupper(Str::random(10)),
                'paid_at' => now(),
                'expired_at' => now()->addMinutes(30),
            ]);

            // STEP 3: UPDATE STATUS SETIAP CART KE 'paid' (MENUNGGU PERSETUJUAN MANAGER)
            // CATATAN ATURAN BARU: STOK UNIT BELUM BERKURANG SEBELUM MANAGER APPROVE!
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

                $itemDelivery = ($cart->vehicle->vehicle_type === 'car') ? 50000 : 25000;
                $itemTotal = $cart->subtotal + $itemDelivery;

                DB::table('carts')
                    ->where('id', $cart->id)
                    ->update([
                        'status' => 'paid',
                        'booking_code' => $bookingCode,
                        'delivery_fee' => $itemDelivery,
                        'total_payment' => $itemTotal,
                        'pickup_location' => $user->address . ', ' . $user->location,
                        'payment_deadline' => now()->addMinutes(30),
                        'updated_at' => now(),
                    ]);

                $counter++;
            }

            DB::commit();

            return redirect()->route('user.payment.success', ['booking_code' => $firstBookingCode])
                ->with('success', 'Pembayaran berhasil! Pesanan menunggu persetujuan manager armada.');

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
