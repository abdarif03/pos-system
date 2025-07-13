<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'description' => 'Memiliki akses penuh ke semua fitur sistem',
                'permissions' => ['dashboard', 'products', 'transactions', 'reports', 'users', 'settings'],
                'is_active' => true
            ],
            [
                'name' => 'Admin',
                'description' => 'Admin dengan akses terbatas untuk manajemen produk dan transaksi',
                'permissions' => ['dashboard', 'products', 'transactions', 'reports'],
                'is_active' => true
            ],
            [
                'name' => 'Kasir',
                'description' => 'Kasir yang dapat melakukan transaksi dan melihat laporan',
                'permissions' => ['dashboard', 'transactions', 'reports'],
                'is_active' => true
            ],
            [
                'name' => 'Staff',
                'description' => 'Staff dengan akses terbatas untuk melihat dashboard dan produk',
                'permissions' => ['dashboard', 'products'],
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
