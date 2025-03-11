<?php

// database/seeders/UserRoutePreferencesSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRoutePreferences;
use App\Models\User;
use App\Models\Route;

class UserRoutePreferencesSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Get the first user (assuming one user exists)
        $route = Route::first(); // Get the first route (assuming one route exists)

        UserRoutePreferences::create([
            'user_id' => $user->id,
            'route_id' => $route->id,
        ]);
    }
}