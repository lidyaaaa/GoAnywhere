<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Fine;
use App\Models\Vehicle;
use App\Models\RentalHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class RentalController extends Controller
{
    public function index()
    {
        // 🔥 KENDARAAN BELUM DIAMBIL (PAID)
        $pendingPickup = Cart::where('user_id', auth()->id())
            ->where('status', 'paid')
            ->with('vehicle')
            ->get();

        // Sewa aktif
        $activeRentals = Cart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->with('vehicle')
            ->get();

        // Riwayat transaksi
        $history = Cart::where('user_id', auth()->id())
            ->whereIn('status', ['completed', 'cancelled'])
            ->with('vehicle')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Statistik
        $totalRentals = Cart::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->count();

        $totalSpent = Cart::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->sum('subtotal');

        return view('user.rental.index', compact(
            'pendingPickup', 
            'activeRentals', 
            'history', 
            'totalRentals', 
            'totalSpent'
        ));
    }

    public function return($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $now = now();
        $endDate = Carbon::parse($cart->rental_end_date);
        $tolerance = $endDate->copy()->addMinutes(30);

        // Cek telat
        $isLate = $now > $tolerance;
        $fineAmount = 0;
        $lateMinutes = 0;

        if ($isLate) {
            $lateMinutes = $now->diffInMinutes($endDate);
            $hoursLate = ceil($lateMinutes / 60);
            $fineAmount = $hoursLate * 50000; // Rp 50.000/jam
        }

        return view('user.rental.return', compact('cart', 'isLate', 'fineAmount', 'lateMinutes'));
    }

    public function processReturn(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();

        $now = now();
        $endDate = Carbon::parse($cart->rental_end_date);
        $tolerance = $endDate->copy()->addMinutes(30);

        $isLate = $now > $tolerance;
        $fineAmount = 0;
        $lateMinutes = 0;

        if ($isLate) {
            $lateMinutes = $now->diffInMinutes($endDate);
            $hoursLate = ceil($lateMinutes / 60);
            $fineAmount = $hoursLate * 50000;

            // Simpan denda
            Fine::create([
                'id' => Str::uuid(),
                'cart_id' => $cart->id,
                'user_id' => auth()->id(),
                'vehicle_id' => $cart->vehicle_id,
                'late_minutes' => $lateMinutes,
                'fine_per_hour' => 50000,
                'total_fine' => $fineAmount,
                'payment_status' => 'pending',
            ]);

            $cart->fine_amount = $fineAmount;
            $cart->is_late = true;
            $cart->late_minutes = $lateMinutes;
        }

        $cart->status = 'completed';
        $cart->returned_at = $now;
        $cart->save();

        // Kembalikan stok
        $vehicle = Vehicle::find($cart->vehicle_id);
        $vehicle->available_stock += 1;
        $vehicle->save();

        // Simpan ke rental history
        RentalHistory::create([
            'id' => Str::uuid(),
            'cart_id' => $cart->id,
            'user_id' => auth()->id(),
            'vehicle_id' => $cart->vehicle_id,
            'vehicle_name' => $vehicle->name,
            'quantity' => $cart->quantity,
            'total_price' => $cart->subtotal,
            'start_date' => $cart->rental_start_date,
            'end_date' => $cart->rental_end_date,
            'pickup_location' => $cart->pickup_location,
            'status' => 'completed',
            'returned_at' => $now,
            'fine_amount' => $fineAmount,
        ]);

        if ($isLate) {
            return redirect()->route('user.rental.fine', $cart->id)
                ->with('warning', 'Kendaraan terlambat dikembalikan! Silahkan bayar denda.');
        }

        return redirect()->route('user.rental')->with('success', 'Kendaraan berhasil dikembalikan tepat waktu!');
    }

    public function fine($id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $fine = Fine::where('cart_id', $cart->id)->first();

        return view('user.rental.fine', compact('cart', 'fine'));
    }

    public function payFine(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,gopay,dana,ovo',
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $fine = Fine::where('cart_id', $cart->id)->first();
        $fine->payment_status = 'paid';
        $fine->payment_method = $request->payment_method;
        $fine->paid_at = now();
        $fine->save();

        return redirect()->route('user.rental')->with('success', 'Denda berhasil dibayar!');
    }

    public function startRental($booking_code)
    {
        $carts = Cart::where('user_id', auth()->id())
            ->where('booking_code', $booking_code)
            ->where('status', 'paid')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Transaksi tidak ditemukan!');
        }

        // Update status ke active
        foreach ($carts as $cart) {
            $cart->status = 'active';
            $cart->rental_start_date = now();
            $cart->save();
        }

        return redirect()->route('user.rental')->with('success', 'Kendaraan berhasil diambil! Selamat menggunakan!');
    }
}