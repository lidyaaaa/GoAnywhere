<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $location = auth()->user()->location;
        
        // Statistik
        $totalVehicles = Vehicle::where('location', $location)->count();
        $totalCars = Vehicle::where('location', $location)->where('vehicle_type', 'car')->count();
        $totalMotorcycles = Vehicle::where('location', $location)->where('vehicle_type', 'motorcycle')->count();
        $totalStock = Vehicle::where('location', $location)->sum('total_stock');
        $availableStock = Vehicle::where('location', $location)->sum('available_stock');
        
        $paidStatuses = ['paid', 'approved', 'active', 'pending_return', 'pending_payment', 'completed'];

        // TOTAL INCOME CABANG (Realtime dari seluruh transaksi berbayar + denda & reparasi lunas di cabang ini)
        $totalRentalIncome = Cart::whereIn('status', $paidStatuses)
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->selectRaw('SUM(CASE WHEN total_payment > 0 THEN total_payment ELSE subtotal END) as total')
            ->value('total') ?? 0;

        $totalFineIncome = Cart::where('status', 'completed')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->selectRaw('SUM(GREATEST(0, COALESCE(fine_amount, 0)) + GREATEST(0, COALESCE(damage_fee, 0))) as total')
            ->value('total') ?? 0;

        $totalIncome = $totalRentalIncome + $totalFineIncome;
        
        // TOTAL SEWA AKTIF
        $totalActiveRentals = Cart::where('status', 'active')
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->count();
        
        // TOTAL TRANSAKSI CABANG
        $totalHistory = Cart::whereIn('status', $paidStatuses)
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
        
        // Riwayat transaksi terakhir cabang (Realtime dengan paginasi)
        $recentHistory = Cart::whereIn('status', $paidStatuses)
            ->whereHas('vehicle', function($q) use ($location) {
                $q->where('location', $location);
            })
            ->with(['vehicle', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'recent_page')
            ->withQueryString();
        
        // Kendaraan rusak yang butuh perbaikan
        $damagedVehicles = Vehicle::where('location', $location)
            ->where('damaged_stock', '>', 0)
            ->get();
        $totalDamagedStock = Vehicle::where('location', $location)->sum('damaged_stock');

        // ============================================================
        // LAPORAN PEMASUKAN BULANAN KHUSUS CABANG MANAGER INI
        // ============================================================
        $currentYear = now()->year;
        $indoMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $monthsMap = [];
        for ($m = 1; $m <= 12; $m++) {
            $key = sprintf('%04d-%02d', $currentYear, $m);
            $monthsMap[$key] = (object) [
                'month_key' => $key,
                'month_name' => $indoMonths[$m] . ' ' . $currentYear,
            ];
        }

        $dbMonths = Cart::whereIn('status', $paidStatuses)
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month_key")
            ->groupBy('month_key')
            ->pluck('month_key');

        foreach ($dbMonths as $key) {
            if ($key && !isset($monthsMap[$key])) {
                [$y, $mNum] = explode('-', $key);
                $monthsMap[$key] = (object) [
                    'month_key' => $key,
                    'month_name' => ($indoMonths[(int)$mNum] ?? $key) . ' ' . $y,
                ];
            }
        }

        ksort($monthsMap);
        $availableMonths = collect(array_values($monthsMap));

        $defaultMonth = now()->format('Y-m');
        $selectedMonth = $request->query('month', $defaultMonth);

        $monthlyBaseQuery = Cart::whereIn('status', $paidStatuses)
            ->whereHas('vehicle', fn($q) => $q->where('location', $location))
            ->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$selectedMonth])
            ->with(['vehicle', 'user'])
            ->orderBy('created_at', 'desc');

        $monthlyRentalRevenue = (clone $monthlyBaseQuery)
            ->selectRaw('SUM(CASE WHEN total_payment > 0 THEN total_payment ELSE subtotal END) as total')
            ->value('total') ?? 0;

        $monthlyFineRevenue = (clone $monthlyBaseQuery)
            ->where('status', 'completed')
            ->selectRaw('SUM(GREATEST(0, COALESCE(fine_amount, 0)) + GREATEST(0, COALESCE(damage_fee, 0))) as total')
            ->value('total') ?? 0;

        $monthlyTotalRevenue = $monthlyRentalRevenue + $monthlyFineRevenue;

        $monthlyTransactionCount = (clone $monthlyBaseQuery)->count();

        $monthlyItems = $monthlyBaseQuery->paginate(5, ['*'], 'monthly_page')->withQueryString();

        [$selYear, $selMonthNum] = explode('-', $selectedMonth);
        $selectedMonthName = ($indoMonths[(int)$selMonthNum] ?? $selectedMonth) . ' ' . $selYear;
        
        return view('manager.dashboard', compact(
            'totalVehicles', 'totalCars', 'totalMotorcycles',
            'totalStock', 'availableStock', 'activeRentals', 'recentHistory',
            'totalIncome', 'totalActiveRentals', 'totalHistory',
            'damagedVehicles', 'totalDamagedStock',
            'availableMonths', 'selectedMonth', 'selectedMonthName',
            'monthlyRentalRevenue', 'monthlyFineRevenue', 'monthlyTotalRevenue',
            'monthlyTransactionCount', 'monthlyItems'
        ));
    }
}