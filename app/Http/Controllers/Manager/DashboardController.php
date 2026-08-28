<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $location = auth()->user()->location;
        
        // Statistik
        $totalVehicles = Vehicle::where('location', $location)->count();
        $totalCars = Vehicle::where('location', $location)->where('vehicle_type', 'car')->count();
        $totalMotorcycles = Vehicle::where('location', $location)->where('vehicle_type', 'motorcycle')->count();
        $totalStock = Vehicle::where('location', $location)->sum('total_stock');
        $availableStock = Vehicle::where('location', $location)->sum('available_stock');
        
        // 🔥 TOTAL INCOME (dari transaksi yang sudah selesai)
        $totalIncome = Cart::whereIn('status', ['completed', 'paid'])
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->sum('subtotal');
        
        // 🔥 TOTAL SEWA AKTIF
        $totalActiveRentals = Cart::where('status', 'active')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->count();
        
        // TOTAL RIWAYAT TRANSAKSI
        $totalHistory = Cart::where('status', 'completed')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->count();
        
        // Sewa aktif (untuk ditampilkan di tabel)
        $activeRentals = Cart::where('status', 'active')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('rental_start_date', 'desc')
            ->get();
        
        // Riwayat transaksi terakhir
        $recentHistory = Cart::where('status', 'completed')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('manager.dashboard', compact(
            'totalVehicles', 'totalCars', 'totalMotorcycles',
            'totalStock', 'availableStock', 'activeRentals', 'recentHistory',
            'totalIncome', 'totalActiveRentals', 'totalHistory' // 🔥 BARU
        ));
    }
}