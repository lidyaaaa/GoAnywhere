<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Global
        $totalUsers = User::where('role', 'user')->count();
        $totalManagers = User::where('role', 'manager')->count();
        $totalVehicles = Vehicle::count();
        $totalCars = Vehicle::where('vehicle_type', 'car')->count();
        $totalMotorcycles = Vehicle::where('vehicle_type', 'motorcycle')->count();
        $totalStock = Vehicle::sum('total_stock');
        $availableStock = Vehicle::sum('available_stock');
        
        // Transaksi
        $totalTransactions = Cart::where('status', 'completed')->count();
        $totalRevenue = Cart::where('status', 'completed')->sum('subtotal');
        $activeRentals = Cart::where('status', 'active')->count();
        
        // Statistik per lokasi
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        $locationStats = [];
        foreach ($locations as $loc) {
            $locationStats[$loc] = [
                'vehicles' => Vehicle::where('location', $loc)->count(),
                'active_rentals' => Cart::where('status', 'active')
                    ->whereHas('vehicle', function($q) use ($loc) {
                        $q->where('location', $loc);
                    })->count(),
                'revenue' => Cart::where('status', 'completed')
                    ->whereHas('vehicle', function($q) use ($loc) {
                        $q->where('location', $loc);
                    })->sum('subtotal'),
            ];
        }
        
        // Transaksi terbaru
        $recentTransactions = Cart::where('status', 'completed')
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('superadmin.dashboard', compact(
            'totalUsers', 'totalManagers', 'totalVehicles',
            'totalCars', 'totalMotorcycles', 'totalStock',
            'availableStock', 'totalTransactions', 'totalRevenue',
            'activeRentals', 'locationStats', 'recentTransactions'
        ));
    }
}