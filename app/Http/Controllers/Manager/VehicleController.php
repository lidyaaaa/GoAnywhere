<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $location = auth()->user()->location;
        $vehicles = Vehicle::where('location', $location)->paginate(10); // 10 per halaman (2x5)
        return view('manager.vehicles', compact('vehicles'));
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
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'transmission' => 'nullable|in:manual,automatic',
            'transmission_motor' => 'nullable|in:matic,manual',
            'capacity' => 'required|integer|min:1',
            'color' => 'required|string|max:50',
            'fuel' => 'required|string|max:50',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'total_stock' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicles', 'public');
        }

        Vehicle::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'year' => $request->year,
            'transmission' => $request->transmission,
            'transmission_motor' => $request->transmission_motor,
            'capacity' => $request->capacity,
            'color' => $request->color,
            'fuel' => $request->fuel,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
            'total_stock' => $request->total_stock,
            'available_stock' => $request->total_stock,
            'location' => auth()->user()->location,
            'manager_id' => auth()->id(),
            'status' => 'available',
            'image' => $imagePath,
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
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'transmission' => 'nullable|in:manual,automatic',
            'transmission_motor' => 'nullable|in:matic,manual',
            'capacity' => 'required|integer|min:1',
            'color' => 'required|string|max:50',
            'fuel' => 'required|string|max:50',
            'price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($vehicle->image) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $imagePath = $request->file('image')->store('vehicles', 'public');
            $vehicle->image = $imagePath;
        }

        $vehicle->update([
            'name' => $request->name,
            'vehicle_type' => $request->vehicle_type,
            'brand' => $request->brand,
            'type' => $request->type,
            'year' => $request->year,
            'transmission' => $request->transmission,
            'transmission_motor' => $request->transmission_motor,
            'capacity' => $request->capacity,
            'color' => $request->color,
            'fuel' => $request->fuel,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
        ]);

        return redirect()->route('manager.vehicles')->with('success', 'Kendaraan berhasil diperbarui!');
    }

    public function addStock(Request $request, $id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);

        $request->validate([
            'stock' => 'required|integer|min:1',
        ]);

        $vehicle->total_stock += $request->stock;
        $vehicle->available_stock += $request->stock;
        $vehicle->save();

        return redirect()->route('manager.vehicles')->with('success', 'Stok berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::where('location', auth()->user()->location)->findOrFail($id);
        
        $hasActiveRental = \App\Models\Cart::where('vehicle_id', $id)
            ->whereIn('status', ['active', 'paid'])
            ->exists();

        if ($hasActiveRental) {
            return back()->with('error', 'Kendaraan sedang disewa, tidak bisa dihapus!');
        }

        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()->route('manager.vehicles')->with('success', 'Kendaraan berhasil dihapus!');
    }
}