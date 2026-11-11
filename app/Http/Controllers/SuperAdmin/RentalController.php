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
            ->paginate(10, ['*'], 'rentals_page');

        $history = Cart::where('status', 'completed')
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'history_page');

        return view('superadmin.rentals', compact('rentals', 'history'));
    }
}