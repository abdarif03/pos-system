<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Basic',
                'slug' => Str::slug('Basic'),
                'description' => 'Basic package suitable for small businesses.',
                'price' => 100000,
                'duration_months' => 1,
                'features' => ['1 user', 'Basic support', 'Limited reports'],
                'is_active' => true,
            ],
            [
                'name' => 'Premium',
                'slug' => Str::slug('Premium'),
                'description' => 'Premium package for growing businesses.',
                'price' => 250000,
                'duration_months' => 3,
                'features' => ['5 users', 'Priority support', 'Advanced reports', 'API access'],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'slug' => Str::slug('Enterprise'),
                'description' => 'Enterprise package for large businesses.',
                'price' => 750000,
                'duration_months' => 12,
                'features' => ['Unlimited users', 'Dedicated support', 'Custom integrations', 'All features'],
                'is_active' => true,
            ],
        ];

        foreach ($packages as $data) {
            Package::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
} 