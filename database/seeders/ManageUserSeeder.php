<?php

namespace Database\Seeders;

use App\Models\ManageUser;
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
        // Create admin user
        ManageUser::firstOrCreate([
            'email' => 'admin@pos-system.test'
        ], [
            'name' => 'System Administrator',
            'email' => 'admin@pos-system.test',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
        ]);

        // Create manager user
        ManageUser::firstOrCreate([
            'email' => 'manager@pos-system.test'
        ], [
            'name' => 'Client Manager',
            'email' => 'manager@pos-system.test',
            'password' => Hash::make('manager123'),
            'role' => 'admin',
        ]);

        // Create supervisor user
        ManageUser::firstOrCreate([
            'email' => 'supervisor@pos-system.test'
        ], [
            'name' => 'Payment Supervisor',
            'email' => 'supervisor@pos-system.test',
            'password' => Hash::make('supervisor123'),
            'role' => 'staff',
        ]);

        $this->command->info('Manage system users created successfully!');
        $this->command->info('Admin: admin@pos-system.test / admin123');
        $this->command->info('Manager: manager@pos-system.test / manager123');
        $this->command->info('Supervisor: supervisor@pos-system.test / supervisor123');
    }
} 