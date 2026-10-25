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
                'name' => 'Kaos Anak Motif Dinosaurus',
                'slug' => 'kaos-anak-motif-dinosaurus',
                'description' => 'Kaos anak dengan motif dinosaurus lucu, bahan katun combed 30s, nyaman dipakai sepanjang hari. Tersedia ukuran 2-10 tahun.',
                'price' => 45000,
                'category_id' => $kaosCategory?->id,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Celana Kargo Anak Cokelat',
                'slug' => 'celana-kargo-anak-cokelat',
                'description' => 'Celana kargo anak dengan banyak kantong, bahan drill tebal dan kuat. Cocok untuk bermain outdoor.',
                'price' => 75000,
                'category_id' => $celanaCategory?->id,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Kaos + Celana Pendek Anak',
                'slug' => 'setelan-kaos-celana-pendek-anak',
                'description' => 'Setelan kaos oblong dan celana pendek matching. Bahan adem, cocok untuk santai di rumah atau jalan-jalan.',
                'price' => 99000,
                'category_id' => $setelanCategory?->id,
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
