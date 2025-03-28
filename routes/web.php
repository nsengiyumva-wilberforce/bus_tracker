<?php

use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\BusStopController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\PassengerController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\TrackingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Bus;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $buses = Bus::get();
    $routes = \App\Models\Route::get();
    return view('pages.dashboard', compact('buses', 'routes'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tables', function () {
    return view('pages.table');
})->middleware(['auth', 'verified'])->name('table');

Route::resource('buses', BusController::class);

Route::resource('routes', RouteController::class);

Route::resource('maintenances', MaintenanceController::class);

Route::resource('passengers', PassengerController::class);

Route::resource('tickets', TicketController::class);

Route::resource('tracking', TrackingController::class);

Route::resource('users', UserController::class);

Route::resource('drivers', StaffController::class);

Route::resource('reports', ReportController::class);

Route::resource('bus-stops', BusStopController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
