<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Cart;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::where('available_stock', '>', 0);

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $query->where('vehicle_type', $request->type);
        }

        // Filter by location
        if ($request->has('location') && $request->location != '') {
            $query->where('location', $request->location);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price_per_day', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // Search by name or brand
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        // =============================================
        // 🔥 SORTING - Terbaru, Termurah, Termahal
        // =============================================
        if ($request->has('sort') && $request->sort != '') {
            switch ($request->sort) {
                case 'terbaru':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'termurah':
                    $query->orderBy('price_per_day', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('price_per_day', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            // Default: terbaru
            $query->orderBy('created_at', 'desc');
        }

        // =============================================
        // 🔥 PAGINATION 12 PER HALAMAN (3x4)
        // =============================================
        $vehicles = $query->paginate(12);
        
        // Simpan filter ke session untuk pagination
        $vehicles->appends($request->all());

        $locations = ['Jakarta', 'Bogor', 'Depok', 'Tangerang', 'Bekasi'];
        
        // Range harga untuk slider
        $minPrice = Vehicle::min('price_per_day') ?? 0;
        $maxPrice = Vehicle::max('price_per_day') ?? 1000000;

        // Ambil status booking/sewa user yang sedang aktif atau menunggu persetujuan (per vehicle)
        // Serta cek kuota jenis kendaraan (1 mobil, 1 motor)
        $userBookedVehicles = [];
        $hasActiveCar = false;
        $hasActiveMotorcycle = false;

        if (auth()->check()) {
            $userCarts = Cart::with('vehicle')
                ->where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'paid', 'active'])
                ->get();

            foreach ($userCarts as $c) {
                if (in_array($c->status, ['paid', 'active'])) {
                    $userBookedVehicles[$c->vehicle_id] = $c->status;
                }

                $type = $c->vehicle?->vehicle_type;
                if ($type === 'car') {
                    $hasActiveCar = true;
                } elseif ($type === 'motorcycle') {
                    $hasActiveMotorcycle = true;
                }
            }
        }

        return view('user.armada.index', compact(
            'vehicles',
            'locations',
            'minPrice',
            'maxPrice',
            'userBookedVehicles',
            'hasActiveCar',
            'hasActiveMotorcycle'
        ));
    }

    public function detail($id)
    {
        $vehicle = Vehicle::with('manager')->findOrFail($id);
        
        // Stok murni dari database (sudah langsung dipotong saat checkout)
        $availableStock = max(0, (int) $vehicle->available_stock);

        // Cek apakah user sedang booking (paid/menunggu persetujuan) atau sewa sedang aktif
        $userActiveRental = null;
        $hasActiveCar = false;
        $hasActiveMotorcycle = false;

        if (auth()->check()) {
            $userCarts = Cart::with('vehicle')
                ->where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'paid', 'active'])
                ->get();

            foreach ($userCarts as $c) {
                if ($c->vehicle_id == $id && in_array($c->status, ['paid', 'active'])) {
                    $userActiveRental = $c;
                }

                $type = $c->vehicle?->vehicle_type;
                if ($type === 'car') {
                    $hasActiveCar = true;
                } elseif ($type === 'motorcycle') {
                    $hasActiveMotorcycle = true;
                }
            }
        }

        return view('user.armada.detail', compact(
            'vehicle',
            'availableStock',
            'userActiveRental',
            'hasActiveCar',
            'hasActiveMotorcycle'
        ));
    }
}
