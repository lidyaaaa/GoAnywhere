<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Jika akun ditangguhkan / diban, langsung logout dan tolak akses
        if (Auth::user()->suspended_at && Auth::user()->role === 'user') {
            $reason = Auth::user()->suspended_reason ?: 'Akun Anda ditangguhkan.';
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->withErrors(['email' => $reason]);
        }

        $userRole = Auth::user()->role;

        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect berdasarkan role
        if ($userRole == 'superadmin') {
            return redirect('/superadmin/dashboard');
        } elseif ($userRole == 'manager') {
            return redirect('/manager/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}