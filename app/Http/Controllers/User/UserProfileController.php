<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // PROFILE USER (edit nama/email/password)
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.user', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // PROFILE PERUSAHAAN (5 lokasi + kontak)
    public function company()
    {
        $locations = [
            'Jakarta' => [
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'maps' => 'https://www.google.com/maps/search/Jl.+Sudirman+No.+123+Jakarta+Pusat',
                'phone' => '(021) 1234-5678',
                'hours' => '08:00 - 22:00'
            ],
            'Bogor' => [
                'address' => 'Jl. Pajajaran No. 45, Bogor',
                'maps' => 'https://www.google.com/maps/search/Jl.+Pajajaran+No.+45+Bogor',
                'phone' => '(0251) 1234-5678',
                'hours' => '08:00 - 22:00'
            ],
            'Depok' => [
                'address' => 'Jl. Margonda Raya No. 78, Depok',
                'maps' => 'https://www.google.com/maps/search/Jl.+Margonda+Raya+No.+78+Depok',
                'phone' => '(021) 5678-1234',
                'hours' => '08:00 - 22:00'
            ],
            'Tangerang' => [
                'address' => 'Jl. MH Thamrin No. 90, Tangerang',
                'maps' => 'https://www.google.com/maps/search/Jl.+MH+Thamrin+No.+90+Tangerang',
                'phone' => '(021) 9876-5432',
                'hours' => '08:00 - 22:00'
            ],
            'Bekasi' => [
                'address' => 'Jl. Ahmad Yani No. 56, Bekasi',
                'maps' => 'https://www.google.com/maps/search/Jl.+Ahmad+Yani+No.+56+Bekasi',
                'phone' => '(021) 5432-9876',
                'hours' => '08:00 - 22:00'
            ],
        ];

        $contacts = [
            'phone' => '(021) 1234-5678',
            'wa' => '0812-3456-7890',
            'email' => 'info@goanywhere.com',
            'hours' => 'Senin - Minggu (08:00 - 22:00)'
        ];

        return view('user.profile.company', compact('locations', 'contacts'));
    }
}