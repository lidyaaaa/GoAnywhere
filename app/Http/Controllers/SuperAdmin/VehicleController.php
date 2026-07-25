<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('manager')->get();
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        return view('superadmin.vehicles', compact('vehicles', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => 'required|in:car,motorcycle',
            'brand' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'transmission' => 'nullable|in:manual,automatic',
            'transmission_motor' => 'nullable|in:matic,manual',
            'capacity' => 'required|integer|min:1',
            'color' => 'required|string|max:50',
            'fuel' => 'required|string|max:50',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'total_stock' => 'required|integer|min:1',
            'location' => 'required|in:Jakarta,Bogor,Depok,Tangerang,Bekasi',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        // Cari manager otomatis kalo ga dipilih
        $managerId = $request->manager_id;
        if (!$managerId) {
            $manager = User::where('role', 'manager')
                ->where('location', $request->location)
                ->first();
            $managerId = $manager ? $manager->id : null;
        }

        Vehicle::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'year' => $request->year,
            'transmission' => $request->transmission,
            'transmission_motor' => $request->transmission_motor,
            'capacity' => $request->capacity,
            'color' => $request->color,
            'fuel' => $request->fuel,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
            'total_stock' => $request->total_stock,
            'available_stock' => $request->total_stock,
            'location' => $request->location,
            'manager_id' => $managerId,
            'status' => 'available',
        ]);

        return redirect()->route('superadmin.vehicles')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // Cek apakah ada transaksi aktif
        $hasActiveRental = \App\Models\Cart::where('vehicle_id', $id)
            ->whereIn('status', ['active', 'paid'])
            ->exists();

        if ($hasActiveRental) {
            return back()->with('error', 'Kendaraan sedang disewa, tidak bisa dihapus!');
        }

        $vehicle->delete();
        return back()->with('success', 'Kendaraan berhasil dihapus!');
    }
}