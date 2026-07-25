<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalCars = Vehicle::where('vehicle_type', 'car')->count();
        $totalMotorcycles = Vehicle::where('vehicle_type', 'motorcycle')->count();
        $latestVehicles = Vehicle::latest()->take(6)->get();

        return view('user.home', compact('totalVehicles', 'totalCars', 'totalMotorcycles', 'latestVehicles'));
    }
}