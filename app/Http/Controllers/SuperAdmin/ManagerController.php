<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'manager')->get();
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        return view('superadmin.managers', compact('managers', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'location' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi',
            'password' => 'required|min:8',
        ]);

        // Cek apakah lokasi sudah ada managernya
        $existingManager = User::where('role', 'manager')
            ->where('location', $request->location)
            ->exists();
            
        if ($existingManager) {
            return back()->with('error', 'Lokasi ' . $request->location . ' sudah memiliki manager!');
        }

        User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'manager',
            'location' => $request->location,
            'phone' => $request->phone,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('superadmin.managers')->with('success', 'Manager berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $manager = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'location' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi',
            'phone' => 'nullable|string|max:15',
        ]);

        // Cek apakah lokasi sudah ada managernya (kecuali dirinya sendiri)
        $existingManager = User::where('role', 'manager')
            ->where('location', $request->location)
            ->where('id', '!=', $id)
            ->exists();
            
        if ($existingManager) {
            return back()->with('error', 'Lokasi ' . $request->location . ' sudah memiliki manager!');
        }

        $manager->update([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        if ($request->filled('password')) {
            $manager->password = Hash::make($request->password);
            $manager->save();
        }

        return redirect()->route('superadmin.managers')->with('success', 'Manager berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $manager = User::findOrFail($id);
        
        // Cek apakah manager punya kendaraan
        $hasVehicles = \App\Models\Vehicle::where('manager_id', $id)->exists();
        
        if ($hasVehicles) {
            return back()->with('error', 'Manager masih memiliki kendaraan, tidak bisa dihapus!');
        }
        
        $manager->delete();
        return back()->with('success', 'Manager berhasil dihapus!');
    }
}