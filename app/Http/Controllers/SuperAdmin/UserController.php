<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $statusTab = $request->query('status', 'active'); // 'active', 'inactive' (disbanded), 'all'

        $query = User::where('role', 'user')->orderBy('created_at', 'desc');

        if ($statusTab === 'active') {
            $query->whereNull('suspended_at');
        } elseif ($statusTab === 'inactive') {
            $query->whereNotNull('suspended_at');
        }

        $users = $query->paginate(10)->withQueryString();

        $activeCount = User::where('role', 'user')->whereNull('suspended_at')->count();
        $inactiveCount = User::where('role', 'user')->whereNotNull('suspended_at')->count();
        $totalCount = $activeCount + $inactiveCount;
        
        foreach ($users as $user) {
            // Ambil sewa aktif (status active)
            $activeRentals = \App\Models\Cart::where('user_id', $user->id)
                ->whereIn('status', ['active', 'paid'])
                ->with('vehicle')
                ->get();
            
            $user->has_active_rental = $activeRentals->count() > 0;
            $user->active_rentals = $activeRentals;
            $user->total_rentals = \App\Models\Cart::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count();
        }
        
        return view('superadmin.users', compact('users', 'statusTab', 'activeCount', 'inactiveCount', 'totalCount'));
    }

    public function toggleBan(Request $request, $id)
    {
        $user = User::where('role', 'user')->findOrFail($id);

        if ($user->suspended_at) {
            $user->suspended_at = null;
            $user->suspended_reason = null;
            $user->save();

            return back()->with('success', "Akun user {$user->name} berhasil diaktifkan kembali.");
        }

        $request->validate([
            'reason' => 'required|string|max:255',
        ], [
            'reason.required' => 'Alasan disband akun wajib diisi.',
        ]);

        $reason = $request->input('reason');
        $user->suspended_at = now();
        $user->suspended_reason = $reason;
        $user->save();

        return back()->with('success', "Akun user {$user->name} berhasil dinonaktifkan (disband).");
    }
}