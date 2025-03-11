<?php
// database/seeders/RouteSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\BusStop;

class RouteSeeder extends Seeder
{
    public function run()
    {
        // Get bus stops (assuming you already have some bus stops in the database)
        $startStation1 = BusStop::first(); // Get the first bus stop
        $endStation1 = BusStop::skip(1)->first(); // Get the second bus stop

        $startStation2 = BusStop::skip(2)->first(); // Get the third bus stop
        $endStation2 = BusStop::skip(3)->first(); // Get the fourth bus stop

        // Insert sample routes with starting and ending stations, and timetable
        Route::create([
            'name' => 'Route 1: Central Station to Downtown',
            'starting_station_id' => $startStation1 ? $startStation1->id : null,
            'ending_station_id' => $endStation1 ? $endStation1->id : null,
            'timetable' => json_encode([
                '08:00 AM' => 'Central Station',
                '08:15 AM' => 'Downtown',
            ]),
        ]);

        Route::create([
            'name' => 'Route 2: Park Avenue to Airport',
            'starting_station_id' => $startStation2 ? $startStation2->id : null,
            'ending_station_id' => $endStation2 ? $endStation2->id : null,
            'timetable' => json_encode([
                '09:00 AM' => 'Park Avenue',
                '09:30 AM' => 'Airport',
            ]),
        ]);

        // You can add more routes similarly by fetching more bus stops
    }
}

