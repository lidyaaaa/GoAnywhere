<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Statistik Global
        $totalUsers = User::where('role', 'user')->count();
        $totalManagers = User::where('role', 'manager')->count();
        $totalVehicles = Vehicle::count();
        $totalCars = Vehicle::where('vehicle_type', 'car')->count();
        $totalMotorcycles = Vehicle::where('vehicle_type', 'motorcycle')->count();
        $totalStock = Vehicle::sum('total_stock');
        $availableStock = Vehicle::sum('available_stock');
        
        // Transaksi (Semua transaksi yang sudah dibayar / berjalan / selesai secara realtime)
        $paidStatuses = ['paid', 'approved', 'active', 'pending_return', 'pending_payment', 'completed'];
        $totalTransactions = Cart::whereIn('status', $paidStatuses)->count();
        $totalRentalRevenue = Cart::whereIn('status', $paidStatuses)
            ->selectRaw('SUM(CASE WHEN total_payment > 0 THEN total_payment ELSE subtotal END) as total')
            ->value('total') ?? 0;
        $totalFineRevenue = Cart::where('status', 'completed')
            ->selectRaw('SUM(GREATEST(0, COALESCE(fine_amount, 0)) + GREATEST(0, COALESCE(damage_fee, 0))) as total')
            ->value('total') ?? 0;
        $totalRevenue = $totalRentalRevenue + $totalFineRevenue;
        $activeRentals = Cart::where('status', 'active')->count();
        
        // Statistik per lokasi
        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        $locationStats = [];
        foreach ($locations as $loc) {
            $locRentalRev = Cart::whereIn('status', $paidStatuses)
                ->whereHas('vehicle', function($q) use ($loc) {
                    $q->where('location', $loc);
                })
                ->selectRaw('SUM(CASE WHEN total_payment > 0 THEN total_payment ELSE subtotal END) as total')
                ->value('total') ?? 0;

            $locFineRev = Cart::where('status', 'completed')
                ->whereHas('vehicle', function($q) use ($loc) {
                    $q->where('location', $loc);
                })
                ->selectRaw('SUM(GREATEST(0, COALESCE(fine_amount, 0)) + GREATEST(0, COALESCE(damage_fee, 0))) as total')
                ->value('total') ?? 0;

            $locationStats[$loc] = [
                'vehicles' => Vehicle::where('location', $loc)->count(),
                'active_rentals' => Cart::where('status', 'active')
                    ->whereHas('vehicle', function($q) use ($loc) {
                        $q->where('location', $loc);
                    })->count(),
                'revenue' => $locRentalRev + $locFineRev,
            ];
        }
        
        // Transaksi terbaru (realtime dengan paginasi)
        $recentTransactions = Cart::whereIn('status', $paidStatuses)
            ->with(['vehicle', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'recent_page')
            ->withQueryString();
        
        // Daftar 12 Bulan Lengkap untuk tahun berjalan + bulan dari data transaksi historis
        $currentYear = now()->year;
        $indoMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $monthsMap = [];
        // Masukkan semua 12 bulan di tahun berjalan (2026)
        for ($m = 1; $m <= 12; $m++) {
            $key = sprintf('%04d-%02d', $currentYear, $m);
            $monthsMap[$key] = (object) [
                'month_key' => $key,
                'month_name' => $indoMonths[$m] . ' ' . $currentYear,
            ];
        }

        // Tambahkan juga bulan-bulan dari database jika ada tahun lain
        $dbMonths = Cart::whereIn('status', $paidStatuses)
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

        // Bulan terpilih (default: bulan sekarang / terbaru yang ada transaksi)
        $defaultMonth = now()->format('Y-m');
        $selectedMonth = $request->query('month', $defaultMonth);

        // Data transaksi pada bulan terpilih (Realtime berdasarkan tanggal booking created_at)
        $monthlyBaseQuery = Cart::whereIn('status', $paidStatuses)
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

        // Paginasi 5 item per halaman untuk laporan bulanan agar tidak menumpuk
        $monthlyItems = $monthlyBaseQuery->paginate(5, ['*'], 'monthly_page')->withQueryString();

        // Nama label bulan yang dipilih
        [$selYear, $selMonthNum] = explode('-', $selectedMonth);
        $selectedMonthName = ($indoMonths[(int)$selMonthNum] ?? $selectedMonth) . ' ' . $selYear;

        return view('superadmin.dashboard', compact(
            'totalUsers', 'totalManagers', 'totalVehicles',
            'totalCars', 'totalMotorcycles', 'totalStock',
            'availableStock', 'totalTransactions', 'totalRevenue',
            'activeRentals', 'locationStats', 'recentTransactions',
            'availableMonths', 'selectedMonth', 'selectedMonthName',
            'monthlyRentalRevenue', 'monthlyFineRevenue', 'monthlyTotalRevenue',
            'monthlyTransactionCount', 'monthlyItems'
        ));
    }
}