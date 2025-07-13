<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Administrator',
                'email' => 'admin@pos.com',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Manager Toko',
                'email' => 'manager@pos.com',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Kasir 1',
                'email' => 'kasir1@pos.com',
                'password' => Hash::make('password123'),
                'role' => 'cashier'
            ],
            [
                'name' => 'Kasir 2',
                'email' => 'kasir2@pos.com',
                'password' => Hash::make('password123'),
                'role' => 'cashier'
            ],
            [
                'name' => 'Staff Gudang',
                'email' => 'staff@pos.com',
                'password' => Hash::make('password123'),
                'role' => 'user'
            ]
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
