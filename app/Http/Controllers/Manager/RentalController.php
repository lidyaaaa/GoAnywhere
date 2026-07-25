<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class RentalController extends Controller
{
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

        // 🔥 RIWAYAT - status 'completed' ATAU 'paid'
        $history = Cart::whereIn('status', ['completed', 'paid'])
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('manager.rentals', compact('rentals', 'history'));
    }
}