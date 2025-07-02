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
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BusController as ControllersBusController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Models\Bus;

Route::view('/', 'home')->name('home');
Route::get('/booking', [BookController::class, 'booking_ticket'])->name('booking');
Route::get('/manage-bookings', [BookController::class, 'manage_bookings'])->name('manage.bookings');
Route::get('/booking-history', [BookController::class, 'my_history'])->name('booking-history');
Route::post('/booking', [BookController::class, 'book_store'])->name('bookings.store');
Route::get('/bus-tracking', [ControllersBusController::class, 'tracking'])->name('tracking');
Route::get('/bus-routes', [ControllersBusController::class, 'bus_routes'])->name('routes');
Route::get('/bus-stations', [ControllersBusController::class, 'bus_stations'])->name('stations');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/tables', function () {
    return view('pages.table');
})->middleware(['auth', 'verified'])->name('table');



Route::resource('admins', AdminController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('buses', BusController::class);

    Route::resource('routes', RouteController::class);

    Route::resource('maintenances', MaintenanceController::class);

    Route::resource('passengers', PassengerController::class);

    Route::resource('tickets', TicketController::class);

    Route::resource('tracking', TrackingController::class);

    Route::resource('users', UsersController::class);

    Route::resource('drivers', StaffController::class);

    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [ReportsController::class, 'export'])->name('reports.export');
    Route::resource('bus-stops', BusStopController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::post('roles/{role}/permissions/add', [RoleController::class, 'addPermissions'])->name('roles.permissions.add');
    Route::post('roles/{role}/permissions/remove', [RoleController::class, 'removePermissions'])->name('roles.permissions.remove');
});


require __DIR__ . '/auth.php';
