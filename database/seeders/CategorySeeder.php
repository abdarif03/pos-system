<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan',
                'description' => 'Kategori untuk produk makanan dan snack',
                'is_active' => true
            ],
            [
                'name' => 'Minuman',
                'description' => 'Kategori untuk produk minuman dan jus',
                'is_active' => true
            ],
            [
                'name' => 'Rokok',
                'description' => 'Kategori untuk produk rokok dan tembakau',
                'is_active' => true
            ],
            [
                'name' => 'Peralatan',
                'description' => 'Kategori untuk peralatan dan perlengkapan',
                'is_active' => true
            ],
            [
                'name' => 'Kesehatan',
                'description' => 'Kategori untuk produk kesehatan dan obat-obatan',
                'is_active' => true
            ],
            [
                'name' => 'Kebersihan',
                'description' => 'Kategori untuk produk kebersihan dan perawatan',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
