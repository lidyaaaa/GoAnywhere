<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', User::PHONE_REGEX],
            'location' => ['required', 'in:Jakarta,Bogor,Depok,Tangerang,Bekasi'],
            'address' => ['required', 'string', 'max:500'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], array_merge(User::PHONE_MESSAGES, [
            'location.required' => 'Pilih kota wilayah Anda (Jabodetabek).',
            'location.in' => 'Kota wilayah harus salah satu dari: Jakarta, Bogor, Depok, Tangerang, Bekasi.',
            'address.required' => 'Detail alamat lengkap wajib diisi untuk pengantaran unit.',
        ]));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'location' => $request->location,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
