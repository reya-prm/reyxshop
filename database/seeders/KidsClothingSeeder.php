<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Database\Seeder;

class KidsClothingSeeder extends Seeder
{
    /**
     * Seed kids clothing categories and sample products for ReyxShop Kids.
     */
    public function run(): void
    {
        // Update store name
        StoreSetting::updateOrCreate(
            ['key' => 'store_name'],
            ['value' => 'ReyxShop Kids - Pakaian Anak Berkualitas', 'type' => 'string']
        );

        // Categories untuk pakaian anak
        $categories = [
            [
                'name' => 'Kaos Anak',
                'slug' => 'kaos-anak',
                'description' => 'Kaos anak berbahan katun nyaman untuk aktivitas sehari-hari.',
            ],
            [
                'name' => 'Celana Anak',
                'slug' => 'celana-anak',
                'description' => 'Celana panjang, celana pendek, celana kargo untuk anak.',
            ],
            [
                'name' => 'Setelan Anak',
                'slug' => 'setelan-anak',
                'description' => 'Setelan kaos dan celana matching untuk anak.',
            ],
            [
                'name' => 'Jaket & Hoodie',
                'slug' => 'jaket-hoodie',
                'description' => 'Jaket dan hoodie hangat untuk anak.',
            ],
            [
                'name' => 'Baju Tidur',
                'slug' => 'baju-tidur',
                'description' => 'Piyama dan baju tidur nyaman untuk anak.',
            ],
            [
                'name' => 'Aksesoris Anak',
                'slug' => 'aksesoris-anak',
                'description' => 'Topi, tas kecil, dan aksesoris pelengkap anak.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'is_active' => true,
                ]
            );
        }

        $this->command->info('✓ Kids clothing categories seeded');

        // Sample products (optional, bisa dihapus jika mau manual input)
        $kaosCategory = Category::where('slug', 'kaos-anak')->first();
        $celanaCategory = Category::where('slug', 'celana-anak')->first();
        $setelanCategory = Category::where('slug', 'setelan-anak')->first();

        $products = [
            [
                'name' => 'Setelan Kaos Anak Karakter Naruto Shippuden',
                'slug' => 'setelan-kaos-anak-karakter-naruto',
                'description' => 'Setelan baju kaos dan celana pendek anak motif Naruto Shippuden. Bahan katun combed adem, cocok usia 2‑8 tahun.',
                'price' => 89000,
                'category_id' => $setelanCategory?->id,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Anak Motif Stitch Lucu Premium',
                'slug' => 'setelan-anak-motif-stitch-premium',
                'description' => 'Setelan harian anak gambar Stitch menggemaskan. Bahan lembut tidak bikin gerah, cocok untuk main atau tidur.',
                'price' => 95000,
                'category_id' => $setelanCategory?->id,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Kaos Anak Tema Cars Lightning McQueen',
                'slug' => 'setelan-kaos-anak-tema-cars',
                'description' => 'Setelan baju dan celana pendek anak motif mobil Cars. Sablon berkualitas tinggi tidak mudah luntur.',
                'price' => 85000,
                'category_id' => $setelanCategory?->id,
                'stock' => 35,
                'is_active' => true,
            ],
            [
                'name' => 'Kaos Katun Anak Karakter Superhero',
                'slug' => 'kaos-katun-anak-karakter-superhero',
                'description' => 'Kaos oblong anak motif superhero favorit. Bahan 100% katun combed 30s menyerap keringat dengan baik.',
                'price' => 45000,
                'category_id' => $kaosCategory?->id,
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Celana Kargo Panjang Anak Laki-Laki',
                'slug' => 'celana-kargo-panjang-anak-laki-laki',
                'description' => 'Celana kargo anak bahan katun twill tebal namun tetap lembut dan lentur. Dilengkapi saku aktif di sisi kanan kiri.',
                'price' => 79000,
                'category_id' => $celanaCategory?->id,
                'stock' => 40,
                'is_active' => true,
            ],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(
                ['slug' => $prod['slug']],
                $prod
            );
        }

        $this->command->info('✓ Sample kids clothing products seeded');
    }
}
