<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class ManageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create admin role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ], [
            'description' => 'Full access to all features',
            'permissions' => json_encode(['*']),
            'is_active' => true
        ]);

        // Get or create manager role
        $managerRole = Role::firstOrCreate([
            'name' => 'manager'
        ], [
            'description' => 'Access to manage clients and payments',
            'permissions' => json_encode(['clients.*', 'payments.*', 'users.read']),
            'is_active' => true
        ]);

        // Create admin user
        User::firstOrCreate([
            'email' => 'admin@pos-system.test'
        ], [
            'name' => 'System Administrator',
            'email' => 'admin@pos-system.test',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);

        // Create manager user
        User::firstOrCreate([
            'email' => 'manager@pos-system.test'
        ], [
            'name' => 'Client Manager',
            'email' => 'manager@pos-system.test',
            'password' => Hash::make('manager123'),
            'role_id' => $managerRole->id,
        ]);

        // Create supervisor user
        User::firstOrCreate([
            'email' => 'supervisor@pos-system.test'
        ], [
            'name' => 'Payment Supervisor',
            'email' => 'supervisor@pos-system.test',
            'password' => Hash::make('supervisor123'),
            'role_id' => $managerRole->id,
        ]);

        $this->command->info('Manage system users created successfully!');
        $this->command->info('Admin: admin@pos-system.test / admin123');
        $this->command->info('Manager: manager@pos-system.test / manager123');
        $this->command->info('Supervisor: supervisor@pos-system.test / supervisor123');
    }
} 