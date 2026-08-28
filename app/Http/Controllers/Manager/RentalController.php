<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function approve($bookingCode)
    {
        $location = auth()->user()->location;
        $carts = Cart::where('booking_code', $bookingCode)
            ->where('status', 'paid')
            ->whereHas('vehicle', function ($query) use ($location) {
                $query->where('location', $location);
            })
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('manager.rentals')
                ->with('error', 'Transaksi tidak ditemukan atau sudah diproses.');
        }

        $approvedAt = now();

        foreach ($carts as $cart) {
            $startTime = $approvedAt->copy();
            $totalDays = $cart->quantity_days ?? 1;
            if ($cart->period === 'weekly') {
                $totalDays = 7;
            }

            $cart->status = 'active';
            $cart->rental_start_date = $startTime;
            $cart->rental_end_date = $startTime->copy()->addDays($totalDays);
            $cart->save();
        }

        $carts->first()->payment()->update([
            'payment_status' => 'success',
            'paid_at' => $approvedAt,
        ]);

        return redirect()->route('manager.rentals')
            ->with('success', 'Booking ' . $bookingCode . ' berhasil disetujui.');
    }

    public function index()
    {
        $location = auth()->user()->location;

        // 🔥 SEWA AKTIF - status 'active'
        $rentals = Cart::where('status', 'active')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('rental_start_date', 'desc')
            ->get();

        // Transaksi yang sudah dibayar dan menunggu persetujuan manager.
        $pendingApprovals = Cart::where('status', 'paid')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'asc')
            ->get();

        // Riwayat transaksi yang sudah selesai.
        $history = Cart::where('status', 'completed')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('manager.rentals', compact('rentals', 'pendingApprovals', 'history'));
    }
}