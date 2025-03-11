<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            RouteSeeder::class,
            BusSeeder::class,
            BusStopSeeder::class,
            RealTimeLocationSeeder::class,
            UserRoutePreferencesSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}

