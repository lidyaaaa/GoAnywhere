<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Cart::whereIn('status', ['active', 'paid', 'pending'])
            ->with(['vehicle', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        $history = Cart::where('status', 'completed')
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('superadmin.rentals', compact('rentals', 'history'));
    }
}