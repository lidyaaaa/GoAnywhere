<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            // 🔥 Ambil SEMUA sewa aktif (bisa lebih dari 1)
            $activeRentals = \App\Models\Cart::where('user_id', $user->id)
                ->whereIn('status', ['active', 'paid'])
                ->with('vehicle')
                ->get();
            
            $user->has_active_rental = $activeRentals->count() > 0;
            $user->active_rentals = $activeRentals; // 🔥 Simpan semua sewa aktif
            $user->total_rentals = \App\Models\Cart::where('user_id', $user->id)
                ->whereIn('status', ['completed', 'paid'])
                ->count();
        }
        
        return view('superadmin.users', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        $hasActiveRental = \App\Models\Cart::where('user_id', $id)
            ->whereIn('status', ['active', 'paid'])
            ->exists();
            
        if ($hasActiveRental) {
            return back()->with('error', 'User sedang menyewa kendaraan, tidak bisa dihapus!');
        }
        
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}