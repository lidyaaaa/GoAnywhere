<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = User::where('role', 'manager')
            ->withCount('vehicles')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Jumlah armada yang dikelola dihitung murni berdasarkan relasi manager_id
        foreach ($managers as $manager) {
            $manager->assigned_vehicles_count = $manager->vehicles_count;
        }

        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        return view('superadmin.managers', compact('managers', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'location' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi',
            'phone' => ['required', 'string', User::PHONE_REGEX],
            'password' => 'required|min:8',
        ], array_merge(User::PHONE_MESSAGES, [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'name.required' => 'Nama manager wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'location.required' => 'Lokasi penugasan manager wajib dipilih.',
        ]));

        User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'manager',
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return redirect()->route('superadmin.managers')->with('success', 'Manager berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $manager = User::findOrFail($id);
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        return view('superadmin.managers-edit', compact('manager', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $manager = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'location' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi',
            'password' => 'nullable|min:8',
        ]);

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
        
        // Cek apakah manager punya kendaraan yang dikelola langsung (manager_id)
        $vehicleCount = Vehicle::where('manager_id', $id)->count();
        
        if ($vehicleCount > 0) {
            return back()->with('error', "Manager {$manager->name} tidak bisa dihapus karena masih mengelola {$vehicleCount} armada! Pindahkan atau hapus armadanya terlebih dahulu.");
        }
        
        $manager->delete();
        return back()->with('success', "Manager {$manager->name} berhasil dihapus!");
    }
}
