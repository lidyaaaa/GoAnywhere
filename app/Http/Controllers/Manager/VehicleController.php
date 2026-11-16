<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $location = auth()->user()->location;
        $typeFilter = $request->query('type', 'all'); // 'all', 'car', 'motorcycle'

        $carCount = Vehicle::where('location', $location)->where('vehicle_type', 'car')->count();
        $motorCount = Vehicle::where('location', $location)->where('vehicle_type', 'motorcycle')->count();
        $totalCount = $carCount + $motorCount;

        $cars = Vehicle::where('location', $location)
            ->where('vehicle_type', 'car')
            ->orderBy('created_at', 'desc')
            ->get();

        $motorcycles = Vehicle::where('location', $location)
            ->where('vehicle_type', 'motorcycle')
            ->orderBy('created_at', 'desc')
            ->get();

        $allVehicleIds = $cars->pluck('id')->merge($motorcycles->pluck('id'))->toArray();
        $inCartOrBooked = Cart::whereIn('vehicle_id', $allVehicleIds)
            ->whereIn('status', ['paid', 'approved', 'active', 'pending_return', 'pending_payment'])
            ->pluck('vehicle_id')
            ->unique()
            ->toArray();

        return view('manager.vehicles', compact(
            'cars',
            'motorcycles',
            'inCartOrBooked',
            'typeFilter',
            'carCount',
            'motorCount',
            'totalCount'
        ));
    }

    public function create()
    {
        return view('manager.vehicles-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => 'required|in:car,motorcycle',
            'brand' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'transmission' => 'nullable|in:manual,automatic',
            'transmission_motor' => 'nullable|in:matic,manual',
            'capacity' => 'required|integer|min:1',
            'color' => 'required|string|max:50',
            'fuel' => 'required|string|max:50',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_week' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'total_stock' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicles', 'public');
        }

        if ($request->vehicle_type === 'car') {
            $transmission = $request->transmission ?? 'automatic';
            $transmissionMotor = null;
        } else {
            $transmissionMotor = $request->transmission_motor ?? 'matic';
            $transmission = $transmissionMotor === 'matic' ? 'automatic' : 'manual';
        }

        Vehicle::create([
            'id' => Str::uuid(),
            'manager_id' => auth()->id(),
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'year' => $request->year,
            'transmission' => $transmission,
            'transmission_motor' => $transmissionMotor,
            'capacity' => $request->capacity,
            'color' => $request->color,
            'fuel' => $request->fuel,
            'price_per_day' => $request->price_per_day,
            'price_per_week' => $request->price_per_week,
            'description' => $request->description,
            'total_stock' => $request->total_stock,
            'available_stock' => $request->total_stock,
            'damaged_stock' => 0,
            'location' => auth()->user()->location,
            'image' => $imagePath,
            'status' => 'available',
        ]);

        return redirect()->route('manager.vehicles')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);
        return view('manager.vehicles-edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => 'required|in:car,motorcycle',
            'brand' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'transmission' => 'nullable|in:manual,automatic',
            'transmission_motor' => 'nullable|in:matic,manual',
            'capacity' => 'required|integer|min:1',
            'color' => 'required|string|max:50',
            'fuel' => 'required|string|max:50',
            'price_per_day' => 'required|numeric|min:0',
            'price_per_week' => 'required|numeric|min:0',
            'total_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Jika total_stock diubah dari halaman edit
        if ($request->filled('total_stock')) {
            $newTotalStock = max(0, (int) $request->total_stock);
            $rentedStock = max(0, $vehicle->total_stock - $vehicle->available_stock - $vehicle->damaged_stock);
            $minRequiredStock = $rentedStock + $vehicle->damaged_stock;

            if ($newTotalStock < $minRequiredStock) {
                return back()->with('error', "Stok tidak bisa diatur di bawah {$minRequiredStock} unit karena ada {$rentedStock} unit sedang disewa dan {$vehicle->damaged_stock} unit rusak.");
            }

            $vehicle->total_stock = $newTotalStock;
            $vehicle->available_stock = max(0, $newTotalStock - $minRequiredStock);
        }

        if ($request->hasFile('image')) {
            if ($vehicle->image) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $vehicle->image = $request->file('image')->store('vehicles', 'public');
        }

        if ($request->vehicle_type === 'car') {
            $transmission = $request->transmission ?? 'automatic';
            $transmissionMotor = null;
        } else {
            $transmissionMotor = $request->transmission_motor ?? 'matic';
            $transmission = $transmissionMotor === 'matic' ? 'automatic' : 'manual';
        }

        $vehicle->update([
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'year' => $request->year,
            'transmission' => $transmission,
            'transmission_motor' => $transmissionMotor,
            'capacity' => $request->capacity,
            'color' => $request->color,
            'fuel' => $request->fuel,
            'price_per_day' => $request->price_per_day,
            'price_per_week' => $request->price_per_week,
            'description' => $request->description,
            'total_stock' => $vehicle->total_stock,
            'available_stock' => $vehicle->available_stock,
            'status' => $vehicle->available_stock > 0 ? 'available' : 'maintenance',
        ]);

        return redirect()->route('manager.vehicles')->with('success', 'Kendaraan dan stok berhasil diupdate!');
    }

    public function repair($id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);

        if ($vehicle->damaged_stock < 1) {
            return back()->with('error', 'Tidak ada unit rusak untuk kendaraan ini.');
        }

        $vehicle->damaged_stock = max(0, $vehicle->damaged_stock - 1);
        $vehicle->available_stock += 1;
        $vehicle->save();

        return back()->with('success', '1 unit ' . $vehicle->name . ' telah selesai direparasi dan kembali ke stok tersedia!');
    }

    public function addStock(Request $request, $id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);

        $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $newTotalStock = (int) $request->stock;
        $rentedStock = max(0, $vehicle->total_stock - $vehicle->available_stock - $vehicle->damaged_stock);
        $minRequiredStock = $rentedStock + $vehicle->damaged_stock;

        if ($newTotalStock < $minRequiredStock) {
            return back()->with('error', "Stok tidak bisa diatur ke {$newTotalStock} karena ada {$rentedStock} unit sedang disewa dan {$vehicle->damaged_stock} unit rusak.");
        }

        $vehicle->total_stock = $newTotalStock;
        $vehicle->available_stock = max(0, $newTotalStock - $minRequiredStock);
        $vehicle->status = $vehicle->available_stock > 0 ? 'available' : 'maintenance';
        $vehicle->save();

        return redirect()->route('manager.vehicles')->with('success', "Stok {$vehicle->name} berhasil diubah menjadi {$newTotalStock} unit!");
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);
        
        // 1. Cek apakah stok kendaraan belum 0
        if ($vehicle->available_stock > 0 || $vehicle->total_stock > 0) {
            return back()->with('error', 'Kendaraan tidak bisa dihapus karena stok belum 0 (Stok tersedia: ' . $vehicle->available_stock . ', total: ' . $vehicle->total_stock . '). Silakan ubah stok menjadi 0 terlebih dahulu!');
        }

        // 2. Cek apakah sedang dibooking / disewa (paid, approved, active, pending_return, pending_payment)
        $hasActiveRental = Cart::where('vehicle_id', $id)
            ->whereIn('status', ['paid', 'approved', 'active', 'pending_return', 'pending_payment'])
            ->exists();

        if ($hasActiveRental) {
            return back()->with('error', 'Kendaraan sedang dibooking / aktif disewa oleh user, tidak bisa dihapus!');
        }

        // 3. Bersihkan relasi riwayat transaksi selesai/batal agar tidak terkena Foreign Key Constraint (ON DELETE RESTRICT)
        \Illuminate\Support\Facades\DB::table('rental_histories')->where('vehicle_id', $id)->delete();
        \Illuminate\Support\Facades\DB::table('fines')->where('vehicle_id', $id)->delete();
        Cart::where('vehicle_id', $id)->delete();

        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()->route('manager.vehicles')->with('success', 'Kendaraan berhasil dihapus secara permanen!');
    }
}
