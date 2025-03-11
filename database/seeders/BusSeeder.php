<?php

// database/seeders/BusSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Route;

class BusSeeder extends Seeder
{
    public function run()
    {
        // Get some routes
        $route1 = Route::first();  // First route
        $route2 = Route::skip(1)->first();  // Second route

        // Insert buses for these routes
        Bus::create([
            'bus_number' => 'A1234',
            'capacity' => 50,
            'route_id' => $route1 ? $route1->id : null,
            'status' => 'On Time',
        ]);

        Bus::create([
            'bus_number' => 'B5678',
            'capacity' => 40,
            'route_id' => $route2 ? $route2->id : null,
            'status' => 'Delayed',
        ]);

        Bus::create([
            'bus_number' => 'C9876',
            'capacity' => 60,
            'route_id' => $route1 ? $route1->id : null,
            'status' => 'Canceled',
        ]);
    }
}
