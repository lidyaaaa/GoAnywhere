<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LayananController;
use App\Http\Controllers\User\ArmadaController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\RentalController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\DashboardController as ManagerDashboardController;
use App\Http\Controllers\Manager\VehicleController as ManagerVehicleController;
use App\Http\Controllers\Manager\RentalController as ManagerRentalController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\UserController as SuperAdminUserController;
use App\Http\Controllers\SuperAdmin\ManagerController as SuperAdminManagerController;
use App\Http\Controllers\SuperAdmin\VehicleController as SuperAdminVehicleController;
use App\Http\Controllers\SuperAdmin\RentalController as SuperAdminRentalController;

// HOME
Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD USER
Route::get('/dashboard', function () {
    return redirect()->route('user.home');
})->middleware(['auth', 'verified'])->name('dashboard');

// =============================================
// USER ROUTES
// =============================================
Route::middleware(['auth', 'verified', 'role:user'])->prefix('user')->name('user.')->group(function () {
    // HOME
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // LAYANAN
    Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
    
    // ARMADA
    Route::get('/armada', [ArmadaController::class, 'index'])->name('armada');
    Route::get('/armada/{id}', [ArmadaController::class, 'detail'])->name('armada.detail');
    
    // PROFILE PERUSAHAAN (5 lokasi + kontak)
    Route::get('/profile', [UserProfileController::class, 'company'])->name('profile');
    
    // SEWA SAYA (di menu navigasi)
    Route::get('/rental', [RentalController::class, 'index'])->name('rental');
    Route::post('/rental/cancel/{booking_code}', [RentalController::class, 'cancelBooking'])->name('rental.cancel');
    Route::get('/rental/return/{id}', [RentalController::class, 'return'])->name('rental.return');
    Route::post('/rental/process/{id}', [RentalController::class, 'processReturn'])->name('rental.processReturn');
    Route::get('/rental/fine/{id}', [RentalController::class, 'fine'])->name('rental.fine');
    Route::post('/rental/pay-fine/{id}', [RentalController::class, 'payFine'])->name('rental.payFine');
    
    // CART (di dropdown kanan atas)
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update'); // 🔥 TAMBAH INI!
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/payment', [CartController::class, 'processPayment'])->name('cart.payment');
    Route::get('/payment/success/{booking_code}', [CartController::class, 'success'])->name('payment.success');
    
    // PROFILE USER (di dropdown kanan atas)
    Route::get('/profile-user', [UserProfileController::class, 'index'])->name('profile.user');
    Route::put('/profile-user/update', [UserProfileController::class, 'update'])->name('profile.user.update');
});

// =============================================
// MANAGER ROUTES
// =============================================
Route::middleware(['auth', 'verified', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [ManagerDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/vehicles', [ManagerVehicleController::class, 'index'])->name('vehicles');
    Route::get('/vehicles/create', [ManagerVehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [ManagerVehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [ManagerVehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [ManagerVehicleController::class, 'update'])->name('vehicles.update');
    Route::post('/vehicles/{id}/add-stock', [ManagerVehicleController::class, 'addStock'])->name('vehicles.addStock');
    Route::delete('/vehicles/{id}', [ManagerVehicleController::class, 'destroy'])->name('vehicles.destroy');
    
    Route::get('/rentals', [ManagerRentalController::class, 'index'])->name('rentals');
    Route::post('/rentals/{booking_code}/approve', [ManagerRentalController::class, 'approve'])->name('rentals.approve');
});

// =============================================
// SUPERADMIN ROUTES
// =============================================
Route::middleware(['auth', 'verified', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/users', [SuperAdminUserController::class, 'index'])->name('users');
    
    Route::get('/managers', [SuperAdminManagerController::class, 'index'])->name('managers');
    Route::post('/managers', [SuperAdminManagerController::class, 'store'])->name('managers.store');
    Route::put('/managers/{id}', [SuperAdminManagerController::class, 'update'])->name('managers.update');
    Route::delete('/managers/{id}', [SuperAdminManagerController::class, 'destroy'])->name('managers.destroy');
    
    Route::get('/vehicles', [SuperAdminVehicleController::class, 'index'])->name('vehicles');
    Route::delete('/vehicles/{id}', [SuperAdminVehicleController::class, 'destroy'])->name('vehicles.destroy');
    
    Route::get('/rentals', [SuperAdminRentalController::class, 'index'])->name('rentals');
});

// =============================================
// PROFILE (semua role bisa akses)
// =============================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';