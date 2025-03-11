<?php

// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create a SuperAdmin and Admin user
        $superAdminUser = User::create([
            'username' => 'super_admin',
            'email' => 'superadmin@example.com',
            'phone_number' => '1112223333',
            'password' => bcrypt('superadmin123'),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'profile_picture' => 'superadmin.jpg',
            'preferences' => json_encode(['preferred_routes' => [1]]),
        ]);

        $adminUser = User::create([
            'username' => 'admin_user',
            'email' => 'adminuser@example.com',
            'phone_number' => '4445556666',
            'password' => bcrypt('adminuser123'),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'profile_picture' => 'adminuser.jpg',
            'preferences' => json_encode(['preferred_routes' => [2]]),
        ]);

        // Create SuperAdmin and Admin records in the Admin table
        Admin::create([
            'user_id' => $superAdminUser->id,
            'role' => 'SuperAdmin',  // Make sure to use 'SuperAdmin' exactly
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            'role' => 'Admin',  // Make sure to use 'Admin' exactly
        ]);
    }
}
