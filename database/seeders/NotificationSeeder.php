<?php

// database/seeders/NotificationSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use App\Models\Bus;
use App\Models\Route;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        // Get some users, buses, and routes
        $user1 = User::first(); // First user
        $bus1 = Bus::first();   // First bus
        $route1 = Route::first(); // First route

        // Create some sample notifications
        Notification::create([
            'user_id' => $user1 ? $user1->id : null,
            'message' => 'The bus you are tracking is delayed.',
            'bus_id' => $bus1 ? $bus1->id : null,
            'route_id' => $route1 ? $route1->id : null,
            'timestamp' => now(),
            'is_read' => false,
        ]);

        Notification::create([
            'user_id' => $user1 ? $user1->id : null,
            'message' => 'Route 1 is now on time after a delay.',
            'bus_id' => null,
            'route_id' => $route1 ? $route1->id : null,
            'timestamp' => now(),
            'is_read' => false,
        ]);

        // Another user and different notification
        $user2 = User::skip(1)->first(); // Second user
        $bus2 = Bus::skip(1)->first();   // Second bus

        Notification::create([
            'user_id' => $user2 ? $user2->id : null,
            'message' => 'Bus B5678 is now canceled.',
            'bus_id' => $bus2 ? $bus2->id : null,
            'route_id' => null,
            'timestamp' => now(),
            'is_read' => false,
        ]);
    }
}
