<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->query('status', 'all');
        $managerFilter = $request->query('manager_id', 'all');
        $locationFilter = $request->query('location', 'all');
        $search = trim($request->query('search', ''));

        // Ambil semua manager beserta lokasinya
        $managers = User::where('role', 'manager')->orderBy('location')->get();

        // Ambil list lokasi cabang unik
        $locations = Vehicle::select('location')->distinct()->pluck('location')->filter()->values();

        // Query dasar
        $baseQuery = Cart::query()->with(['vehicle', 'user']);

        // Filter Manager / Lokasi
        if ($managerFilter !== 'all' && !empty($managerFilter)) {
            $selectedManager = $managers->firstWhere('id', $managerFilter);
            if ($selectedManager && $selectedManager->location) {
                $baseQuery->whereHas('vehicle', function ($q) use ($selectedManager) {
                    $q->where('location', $selectedManager->location);
                });
            }
        } elseif ($locationFilter !== 'all' && !empty($locationFilter)) {
            $baseQuery->whereHas('vehicle', function ($q) use ($locationFilter) {
                $q->where('location', $locationFilter);
            });
        }

        // Filter Search
        if (!empty($search)) {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
                  })
                  ->orWhereHas('vehicle', function ($vq) use ($search) {
                      $vq->where('name', 'like', "%{$search}%")
                         ->orWhere('brand', 'like', "%{$search}%")
                         ->orWhere('location', 'like', "%{$search}%");
                  });
            });
        }

        // Clone query untuk menghitung counts badge status (sesuai filter manager/search yang aktif)
        $countQuery = clone $baseQuery;
        $statusCounts = [
            'all' => (clone $baseQuery)->count(),
            'paid' => (clone $baseQuery)->where('status', 'paid')->count(),
            'approved' => (clone $baseQuery)->where('status', 'approved')->count(),
            'active' => (clone $baseQuery)->where('status', 'active')->count(),
            'pending_return' => (clone $baseQuery)->where('status', 'pending_return')->count(),
            'pending_payment' => (clone $baseQuery)->where('status', 'pending_payment')->count(),
            'completed' => (clone $baseQuery)->where('status', 'completed')->count(),
            'cancelled' => (clone $baseQuery)->where('status', 'cancelled')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
        ];

        // Overall statistics
        $stats = [
            'total_transactions' => $statusCounts['all'],
            'active_running' => $statusCounts['approved'] + $statusCounts['active'],
            'pending_action' => $statusCounts['paid'] + $statusCounts['pending_return'] + $statusCounts['pending_payment'],
            'completed' => $statusCounts['completed'],
            'total_revenue' => (clone $baseQuery)->where('status', 'completed')->sum('total_payment'),
        ];

        // Filter status pada query utama
        if ($statusFilter !== 'all' && !empty($statusFilter)) {
            $baseQuery->where('status', $statusFilter);
        }

        // Urutkan berdasarkan yang terbaru
        $rentals = $baseQuery->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('superadmin.rentals', compact(
            'rentals',
            'managers',
            'locations',
            'statusCounts',
            'stats',
            'statusFilter',
            'managerFilter',
            'locationFilter',
            'search'
        ));
    }
}
