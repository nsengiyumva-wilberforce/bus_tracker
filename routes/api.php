<?php

// routes/api.php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\BusStopController;
use App\Http\Controllers\RealTimeLocationController;
use App\Http\Controllers\UserRoutePreferencesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Protecting resources using Sanctum
Route::apiResource('users', UsersController::class);
Route::apiResource('admins', AdminController::class);
Route::apiResource('buses', BusController::class);
Route::apiResource('routes', RouteController::class);
Route::apiResource('bus_stops', BusStopController::class);
Route::apiResource('real_time_locations', RealTimeLocationController::class);
Route::apiResource('user_route_preferences', UserRoutePreferencesController::class);
Route::apiResource('notifications', NotificationController::class);
