<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('manager')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];

        // Cek kendaraan yang sedang ada di keranjang atau dibooking/disewa
        $vehicleIds = $vehicles->pluck('id')->toArray();
        $inCartOrBooked = Cart::whereIn('vehicle_id', $vehicleIds)
            ->whereIn('status', ['pending', 'paid', 'active'])
            ->pluck('vehicle_id')
            ->unique()
            ->toArray();

        return view('superadmin.vehicles', compact('vehicles', 'locations', 'inCartOrBooked'));
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // 1. Cek apakah stok kendaraan belum 0
        if ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) {
            return back()->with('error', 'Kendaraan tidak bisa dihapus karena stok belum 0 (Stok tersedia: ' . $vehicle->available_stock . ', total: ' . $vehicle->total_stock . ')!');
        }

        // 2. Cek apakah ada di keranjang user (pending)
        $inPendingCart = Cart::where('vehicle_id', $id)
            ->where('status', 'pending')
            ->exists();

        if ($inPendingCart) {
            return back()->with('error', 'Kendaraan sedang berada di keranjang belanja user, tidak bisa dihapus!');
        }

        // 3. Cek apakah ada transaksi booking / sewa aktif
        $hasActiveRental = Cart::where('vehicle_id', $id)
            ->whereIn('status', ['paid', 'active'])
            ->exists();

        if ($hasActiveRental) {
            return back()->with('error', 'Kendaraan sedang dibooking / aktif disewa oleh user, tidak bisa dihapus!');
        }

        $vehicle->delete();
        return back()->with('success', 'Kendaraan berhasil dihapus!');
    }
}
