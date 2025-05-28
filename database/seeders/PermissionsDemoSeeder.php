<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleStaff = Role::create(['name' => 'staff']);
        $roleCommuter = Role::create(['name' => 'commuter']);

        // Create admin user
        $admin = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@buspulse.com',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'password' => bcrypt('password'), // You can change the default password
        ]);
        $admin->assignRole($roleAdmin);

        // Create staff user
        $staff = User::factory()->create([
            'username' => 'staff',
            'email' => 'staff@buspulse.com',
            'first_name' => 'Staff',
            'last_name' => 'User',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole($roleStaff);

        // Create commuter user
        $commuter = User::factory()->create([
            'username' => 'commuter',
            'email' => 'commuter@buspulse.com',
            'first_name' => 'Commuter',
            'last_name' => 'User',
            'password' => bcrypt('password'),
        ]);
        $commuter->assignRole($roleCommuter);
    }
}
