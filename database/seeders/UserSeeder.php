<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get roles
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $kasirRole = Role::where('name', 'Kasir')->first();
        $staffRole = Role::where('name', 'Staff')->first();

        $users = [
            [
                'name' => 'Super Administrator',
                'email' => 'admin@pos.com',
                'password' => Hash::make('password123'),
                'role_id' => $superAdminRole ? $superAdminRole->id : null
            ],
            [
                'name' => 'Manager Toko',
                'email' => 'manager@pos.com',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole ? $adminRole->id : null
            ],
            [
                'name' => 'Kasir 1',
                'email' => 'kasir1@pos.com',
                'password' => Hash::make('password123'),
                'role_id' => $kasirRole ? $kasirRole->id : null
            ],
            [
                'name' => 'Kasir 2',
                'email' => 'kasir2@pos.com',
                'password' => Hash::make('password123'),
                'role_id' => $kasirRole ? $kasirRole->id : null
            ],
            [
                'name' => 'Staff Gudang',
                'email' => 'staff@pos.com',
                'password' => Hash::make('password123'),
                'role_id' => $staffRole ? $staffRole->id : null
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
