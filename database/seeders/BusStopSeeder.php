<?php
// database/seeders/BusStopSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusStop;

class BusStopSeeder extends Seeder
{
    public function run()
    {
        // Insert some sample bus stops
        BusStop::create([
            'name' => 'Central Station',
            'location' => 'Downtown, City Center',
            'latitude' => 40.712776,   // Example latitude
            'longitude' => -74.005974, // Example longitude
        ]);

        BusStop::create([
            'name' => 'Park Avenue',
            'location' => 'Park Avenue, City Park',
            'latitude' => 40.758896,
            'longitude' => -73.985130,
        ]);

        BusStop::create([
            'name' => 'Airport Terminal',
            'location' => 'Airport, Near Terminal 3',
            'latitude' => 40.641311,
            'longitude' => -73.778139,
        ]);

        BusStop::create([
            'name' => 'Downtown Station',
            'location' => 'Main Street, Downtown',
            'latitude' => 40.748817,
            'longitude' => -73.985428,
        ]);

        BusStop::create([
            'name' => 'Beachside Stop',
            'location' => 'Seaside Boulevard, Beachside',
            'latitude' => 40.730610,
            'longitude' => -73.935242,
        ]);
    }
}
