<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $makananCategory = Category::where('name', 'Makanan')->first();
        $minumanCategory = Category::where('name', 'Minuman')->first();
        $rokokCategory = Category::where('name', 'Rokok')->first();
        $peralatanCategory = Category::where('name', 'Peralatan')->first();

        $products = [
            // Makanan
            [
                'sku' => 'PRD-0001',
                'name' => 'Mie Instan Goreng',
                'category_id' => $makananCategory ? $makananCategory->id : null,
                'stock' => 50,
                'base_price' => 2500,
                'price' => 3500
            ],
            [
                'sku' => 'PRD-0002',
                'name' => 'Biskuit Oreo',
                'category_id' => $makananCategory ? $makananCategory->id : null,
                'stock' => 30,
                'base_price' => 8000,
                'price' => 12000
            ],
            [
                'sku' => 'PRD-0003',
                'name' => 'Snack Chitato',
                'category_id' => $makananCategory ? $makananCategory->id : null,
                'stock' => 25,
                'base_price' => 3000,
                'price' => 5000
            ],

            // Minuman
            [
                'sku' => 'PRD-0004',
                'name' => 'Coca Cola 330ml',
                'category_id' => $minumanCategory ? $minumanCategory->id : null,
                'stock' => 40,
                'base_price' => 4000,
                'price' => 6000
            ],
            [
                'sku' => 'PRD-0005',
                'name' => 'Teh Botol Sosro',
                'category_id' => $minumanCategory ? $minumanCategory->id : null,
                'stock' => 35,
                'base_price' => 3500,
                'price' => 5500
            ],
            [
                'sku' => 'PRD-0006',
                'name' => 'Air Mineral Aqua 600ml',
                'category_id' => $minumanCategory ? $minumanCategory->id : null,
                'stock' => 60,
                'base_price' => 2000,
                'price' => 3000
            ],

            // Rokok
            [
                'sku' => 'PRD-0007',
                'name' => 'Rokok Marlboro Red',
                'category_id' => $rokokCategory ? $rokokCategory->id : null,
                'stock' => 20,
                'base_price' => 15000,
                'price' => 20000
            ],
            [
                'sku' => 'PRD-0008',
                'name' => 'Rokok Sampoerna Mild',
                'category_id' => $rokokCategory ? $rokokCategory->id : null,
                'stock' => 15,
                'base_price' => 12000,
                'price' => 17000
            ],

            // Peralatan
            [
                'sku' => 'PRD-0009',
                'name' => 'Pulpen Standard',
                'category_id' => $peralatanCategory ? $peralatanCategory->id : null,
                'stock' => 100,
                'base_price' => 2000,
                'price' => 3500
            ],
            [
                'sku' => 'PRD-0010',
                'name' => 'Buku Tulis A4',
                'category_id' => $peralatanCategory ? $peralatanCategory->id : null,
                'stock' => 50,
                'base_price' => 5000,
                'price' => 8000
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
