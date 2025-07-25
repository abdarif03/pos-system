<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call seeders in order
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            ManageUserSeeder::class,
            ManageDataSeeder::class,
        ]);
    }
}
