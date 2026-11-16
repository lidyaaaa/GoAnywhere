<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->query('search', ''));
        $managerId = $request->query('manager_id', 'all');
        $managerSearch = trim($request->query('manager_search', ''));
        $location = $request->query('location', 'all');
        $vehicleType = $request->query('vehicle_type', 'all');

        $managers = User::where('role', 'manager')->orderBy('location')->get();
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];

        $query = Vehicle::with('manager');

        // 1. Search by Kendaraan (Nama, Merk, Tipe, Tahun)
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%");
            });
        }

        // 2. Search by Manager (Dropdown Manager ID atau Text Search Manager)
        if ($managerId !== 'all' && !empty($managerId)) {
            $query->where('manager_id', $managerId);
        }

        if (!empty($managerSearch)) {
            $query->whereHas('manager', function($mq) use ($managerSearch) {
                $mq->where('name', 'like', "%{$managerSearch}%")
                   ->orWhere('email', 'like', "%{$managerSearch}%")
                   ->orWhere('location', 'like', "%{$managerSearch}%");
            });
        }

        // 3. Filter Lokasi / Cabang
        if ($location !== 'all' && !empty($location)) {
            $query->where('location', $location);
        }

        // 4. Filter Tipe Kendaraan (Mobil / Motor)
        if ($vehicleType !== 'all' && !empty($vehicleType)) {
            $query->where('vehicle_type', $vehicleType);
        }

        // Statistik Keseluruhan
        $stats = [
            'total_vehicles' => Vehicle::count(),
            'total_cars' => Vehicle::where('vehicle_type', 'car')->count(),
            'total_motorcycles' => Vehicle::where('vehicle_type', 'motorcycle')->count(),
            'total_stock' => Vehicle::sum('total_stock') ?? 0,
            'available_stock' => Vehicle::sum('available_stock') ?? 0,
            'damaged_stock' => Vehicle::sum('damaged_stock') ?? 0,
        ];

        $vehicles = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        // Cek kendaraan yang sedang ada di transaksi aktif (paid, approved, active, pending_return, pending_payment)
        $vehicleIds = $vehicles->pluck('id')->toArray();
        $inCartOrBooked = Cart::whereIn('vehicle_id', $vehicleIds)
            ->whereIn('status', ['paid', 'approved', 'active', 'pending_return', 'pending_payment'])
            ->pluck('vehicle_id')
            ->unique()
            ->toArray();

        return view('superadmin.vehicles', compact(
            'vehicles',
            'managers',
            'locations',
            'inCartOrBooked',
            'stats',
            'search',
            'managerId',
            'managerSearch',
            'location',
            'vehicleType'
        ));
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        // 1. Cek apakah stok kendaraan belum 0
        if ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) {
            return back()->with('error', 'Kendaraan tidak bisa dihapus karena stok belum 0 (Stok tersedia: ' . $vehicle->available_stock . ', total: ' . $vehicle->total_stock . '). Silakan minta manager terkait mengosongkan stok terlebih dahulu!');
        }

        // 2. Cek apakah ada transaksi booking / sewa aktif
        $hasActiveRental = Cart::where('vehicle_id', $id)
            ->whereIn('status', ['paid', 'approved', 'active', 'pending_return', 'pending_payment'])
            ->exists();

        if ($hasActiveRental) {
            return back()->with('error', 'Kendaraan sedang dibooking / aktif disewa oleh user, tidak bisa dihapus!');
        }

        // 3. Bersihkan sisa relasi riwayat/cart yang sudah selesai/batal agar tidak Foreign Key Error
        DB::table('rental_histories')->where('vehicle_id', $id)->delete();
        DB::table('fines')->where('vehicle_id', $id)->delete();
        Cart::where('vehicle_id', $id)->delete();

        if ($vehicle->image && Storage::disk('public')->exists($vehicle->image)) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();
        return back()->with('success', "Armada {$vehicle->name} berhasil dihapus secara permanen!");
    }
}
