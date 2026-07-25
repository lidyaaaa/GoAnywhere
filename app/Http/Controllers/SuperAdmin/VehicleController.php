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