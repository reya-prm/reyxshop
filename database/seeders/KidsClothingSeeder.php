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
            [
                'name' => 'Setelan Kaos Anak Pokemon Pikachu',
                'slug' => 'setelan-kaos-anak-pokemon-pikachu',
                'description' => 'Setelan kaos dan celana motif Pokemon Pikachu. Bahan adem dan lembut untuk anak aktif.',
                'price' => 92000,
                'category_id' => $setelanCategory?->id,
                'stock' => 38,
                'is_active' => true,
            ],
            [
                'name' => 'Kaos Anak Motif Dinosaurus T-Rex',
                'slug' => 'kaos-anak-motif-dinosaurus-trex',
                'description' => 'Kaos anak dengan gambar dinosaurus T-Rex keren. Bahan katun lembut dan sablon tidak mudah pudar.',
                'price' => 42000,
                'category_id' => $kaosCategory?->id,
                'stock' => 55,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Anak Karakter Spiderman',
                'slug' => 'setelan-anak-karakter-spiderman',
                'description' => 'Setelan kaos dan celana pendek tema Spiderman. Favorit anak laki-laki untuk main dan sekolah.',
                'price' => 88000,
                'category_id' => $setelanCategory?->id,
                'stock' => 42,
                'is_active' => true,
            ],
            [
                'name' => 'Celana Jogger Anak Polos Abu-Abu',
                'slug' => 'celana-jogger-anak-polos-abu-abu',
                'description' => 'Celana jogger anak model kekinian bahan babyterry lembut. Pinggang full karet elastis nyaman.',
                'price' => 68000,
                'category_id' => $celanaCategory?->id,
                'stock' => 48,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Kaos Anak Motif Mobil Truk',
                'slug' => 'setelan-kaos-anak-motif-mobil-truk',
                'description' => 'Setelan harian anak gambar truk dan mobil konstruksi. Cocok untuk balita yang suka kendaraan.',
                'price' => 79000,
                'category_id' => $setelanCategory?->id,
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'name' => 'Kaos Anak Karakter Doraemon',
                'slug' => 'kaos-anak-karakter-doraemon',
                'description' => 'Kaos anak motif Doraemon imut. Bahan katun combed halus dan nyaman dipakai.',
                'price' => 48000,
                'category_id' => $kaosCategory?->id,
                'stock' => 52,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Anak Mickey Mouse Disney',
                'slug' => 'setelan-anak-mickey-mouse-disney',
                'description' => 'Setelan resmi lisensi Disney motif Mickey Mouse. Bahan premium dan jahitan rapi.',
                'price' => 105000,
                'category_id' => $setelanCategory?->id,
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Celana Jeans Anak Stretch Biru Dongker',
                'slug' => 'celana-jeans-anak-stretch-biru-dongker',
                'description' => 'Celana jeans anak bahan denim stretch lentur. Model reguler fit cocok untuk sehari-hari.',
                'price' => 85000,
                'category_id' => $celanaCategory?->id,
                'stock' => 35,
                'is_active' => true,
            ],
            [
                'name' => 'Kaos Anak Motif Robot Transformer',
                'slug' => 'kaos-anak-motif-robot-transformer',
                'description' => 'Kaos anak dengan gambar robot Transformer. Sablon 3D timbul keren dan awet.',
                'price' => 52000,
                'category_id' => $kaosCategory?->id,
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Anak Tema Baby Shark',
                'slug' => 'setelan-anak-tema-baby-shark',
                'description' => 'Setelan kaos dan celana pendek motif Baby Shark yang disukai balita. Warna cerah dan ceria.',
                'price' => 75000,
                'category_id' => $setelanCategory?->id,
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Celana Pendek Anak Katun Stretch',
                'slug' => 'celana-pendek-anak-katun-stretch',
                'description' => 'Celana pendek anak bahan katun stretch adem. Tersedia berbagai warna solid untuk mix-match.',
                'price' => 55000,
                'category_id' => $celanaCategory?->id,
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Setelan Kaos Anak Karakter Paw Patrol',
                'slug' => 'setelan-kaos-anak-karakter-paw-patrol',
                'description' => 'Setelan anak motif Paw Patrol (Chase, Marshall, Skye). Favorit balita untuk main dan tidur.',
                'price' => 82000,
                'category_id' => $setelanCategory?->id,
                'stock' => 44,
                'is_active' => true,
            ],
            [
                'name' => 'Kaos Anak Polos Warna-Warni Set 3 Pcs',
                'slug' => 'kaos-anak-polos-warna-warni-set-3pcs',
                'description' => 'Paket 3 kaos anak polos warna-warni. Bahan katun combed berkualitas, harga ekonomis.',
                'price' => 99000,
                'category_id' => $kaosCategory?->id,
                'stock' => 65,
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
