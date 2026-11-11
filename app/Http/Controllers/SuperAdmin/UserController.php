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
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
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

    public function toggleBan(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        if ($user->suspended_at) {
            $user->update([
                'suspended_at' => null,
                'suspended_reason' => null,
            ]);

            return back()->with('success', "Akun user {$user->name} berhasil diaktifkan kembali.");
        }

        $reason = $request->input('reason') ?: 'Akun Anda telah disuspend / diban oleh Super Admin.';
        $user->update([
            'suspended_at' => now(),
            'suspended_reason' => $reason,
        ]);

        return back()->with('success', "Akun user {$user->name} berhasil disuspend (banned).");
    }
}