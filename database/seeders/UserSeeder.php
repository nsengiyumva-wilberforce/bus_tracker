<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'john_doe',
            'email' => 'john.doe@example.com',
            'phone_number' => '1234567890',
            'password' => Hash::make('password123'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'profile_picture' => 'default.jpg',
            'preferences' => json_encode(['preferred_routes' => [1, 2]]),
        ]);

        User::create([
            'username' => 'jane_smith',
            'email' => 'jane.smith@example.com',
            'phone_number' => '0987654321',
            'password' => Hash::make('password123'),
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'profile_picture' => 'default.jpg',
            'preferences' => json_encode(['preferred_routes' => [2, 3]]),
        ]);
    }
}

