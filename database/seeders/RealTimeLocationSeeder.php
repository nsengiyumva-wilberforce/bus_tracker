<?php

// database/seeders/RealTimeLocationSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RealTimeLocation;
use App\Models\Bus;

class RealTimeLocationSeeder extends Seeder
{
    public function run()
    {
        $bus = Bus::first(); // Get the first bus (assuming one bus exists)

        RealTimeLocation::create([
            'bus_id' => $bus->id,
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            'timestamp' => now(),
        ]);

        RealTimeLocation::create([
            'bus_id' => $bus->id,
            'latitude' => 40.7333,
            'longitude' => -74.0100,
            'timestamp' => now(),
        ]);
    }
}
