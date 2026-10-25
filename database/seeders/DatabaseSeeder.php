<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Category;
use App\Models\MarketplaceLink;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductQuestion;
use App\Models\ProductVariant;
use App\Models\QuestionAnswer;
use App\Models\Review;
use App\Models\ReviewReply;
use App\Models\StoreSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with complete realistic ReyxShop off-road data.
     */
    public function run(): void
    {
        // 1. Users (Admin & Operator)
        $admin = User::updateOrCreate(
            ['email' => 'admin@reyxshop.com'],
            [
                'name' => 'Admin ReyxShop',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $operator = User::updateOrCreate(
            ['email' => 'operator@reyxshop.com'],
            [
                'name' => 'Operator ReyxShop',
                'password' => Hash::make('password'),
                'role' => 'operator',
                'email_verified_at' => now(),
            ]
        );

        // 2. Store Settings
        $settings = [
            'store_name' => ['value' => 'ReyxShop Off-Road & Motocross Gear', 'type' => 'string'],
            'is_open' => ['value' => 'true', 'type' => 'boolean'],
            'status_label' => ['value' => 'Buka Hari Ini', 'type' => 'string'],
            'status_notice' => ['value' => 'Toko buka pukul 08:30 - 18:00 WIB. Pengiriman barang langsung di hari yang sama untuk pesanan sebelum 15:00 WIB!', 'type' => 'string'],
            'whatsapp_number' => ['value' => '6281234567890', 'type' => 'string'],
            'whatsapp_display' => ['value' => '+62 812-3456-7890', 'type' => 'string'],
            'address' => ['value' => 'Jl. Jalur Trabas No. 49, Kawasan Motocross Arena, Indonesia', 'type' => 'string'],
            'shopee_url' => ['value' => 'https://shopee.co.id', 'type' => 'string'],
            'lazada_url' => ['value' => 'https://lazada.co.id', 'type' => 'string'],
        ];

        foreach ($settings as $key => $data) {
            StoreSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $data['value'], 'type' => $data['type']]
            );
        }

        // 3. Banners
        Banner::updateOrCreate(
            ['title' => 'Koleksi Trabas & Motocross 2026'],
            [
                'description' => 'Perlengkapan Motocross Lengkap, Original, & Teruji di Medan Ekstrem.',
                'image_path' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=1600&auto=format&fit=crop&q=80',
                'link_url' => '#katalog-unggulan',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        // 4. Categories
        $categoriesData = [
            [
                'name' => 'Jersey & Apparel',
                'slug' => 'jersey-apparel',
                'description' => 'Jersey balap, celana riding, & windbreaker off-road tahan gesek.',
            ],
            [
                'name' => 'Helm & Goggles',
                'slug' => 'helm-goggles',
                'description' => 'Helm trail SNI/DOT & kacamata goggle anti-fog/UV protection.',
            ],
            [
                'name' => 'Sarung Tangan & Boots',
                'slug' => 'sarung-tangan-boots',
                'description' => 'Sepatu boots enduro proteksi engsel & gloves grip maksimal.',
            ],
            [
                'name' => 'Body Protector & Armor',
                'slug' => 'body-protector',
                'description' => 'Chest protector, knee guard, neck brace, & deker proteksi penuh.',
            ],
            [
                'name' => 'Parts & Aksesoris',
                'slug' => 'parts-aksesoris',
                'description' => 'Handguard, stang fatbar, tas trail hidropack, & toolkit adventure.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::updateOrCreate(
                ['slug' => $c['slug']],
                [
                    'name' => $c['name'],
                    'description' => $c['description'],
                    'is_active' => true,
                ]
            );
        }

        // 5. Products, Images, Variants, Marketplace Links, Reviews, Q&A
        $productsData = [
            [
                'category_slug' => 'jersey-apparel',
                'name' => 'Jersey Set Fox Legion Trabas Series 2026',
                'slug' => 'jersey-set-fox-legion-trabas',
                'price' => 485000,
                'stock' => 14,
                'description' => "Jersey Set Fox Legion edisi 2026 dirancang khusus untuk memenuhi standar ketahanan pengendara off-road, motocross, dan trabas hutan.\n\nKeunggulan Produk:\n- Material polyester moisture-wicking yang menjaga tubuh tetap kering dan sejuk.\n- Panel ventilasi mesh bervolume tinggi di area punggung dan ketiak.\n- Celana dilengkapi jahitan ganda (reinforced double stitching) dan kulit pelindung panas knalpot di bagian dalam lutut.\n- Pola potongan ergonomis untuk keleluasaan bergerak saat bermanuver di tikungan maupun jumping.",
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=800&auto=format&fit=crop&q=80', 'is_primary' => true],
                    ['path' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=800&auto=format&fit=crop&q=80', 'is_primary' => false],
                ],
                'variants' => [
                    ['name' => 'Ukuran', 'value' => 'M', 'additional_price' => 0, 'stock' => 4, 'sku' => 'FX-LG-M'],
                    ['name' => 'Ukuran', 'value' => 'L', 'additional_price' => 0, 'stock' => 6, 'sku' => 'FX-LG-L'],
                    ['name' => 'Ukuran', 'value' => 'XL', 'additional_price' => 0, 'stock' => 3, 'sku' => 'FX-LG-XL'],
                    ['name' => 'Ukuran', 'value' => 'XXL', 'additional_price' => 20000, 'stock' => 1, 'sku' => 'FX-LG-XXL'],
                ],
                'marketplace' => [
                    ['marketplace' => 'shopee', 'url' => 'https://shopee.co.id/search?keyword=reyxshop+jersey+fox+legion'],
                    ['marketplace' => 'lazada', 'url' => 'https://www.lazada.co.id/catalog/?q=reyxshop+jersey+fox+legion'],
                ],
                'reviews' => [
                    [
                        'customer_name' => 'Budi Santoso (Trail Adventure Bandung)',
                        'rating' => 5,
                        'content' => 'Bahan adem banget pas dipakai trabas di Ciwidey seharian. Kualitas print rapi dan celananya tebal tahan gesekan ranting.',
                        'reply' => 'Terima kasih Mas Budi! Senang mendengarnya. Semoga awet terus menemani petualangan trabasnya!',
                    ],
                    [
                        'customer_name' => 'Denny Pratama',
                        'rating' => 5,
                        'content' => 'Ukuran L pas di badan 174cm / 70kg. Pengiriman cepat dari ReyxShop dan packing aman.',
                        'reply' => null,
                    ],
                ],
                'questions' => [
                    [
                        'customer_name' => 'Ahmad Reza',
                        'question' => 'Untuk celananya apakah sudah ada padding busa pelindung pinggang?',
                        'answer' => 'Halo Mas Ahmad, sudah ada removable hip pads bawaan yang bisa dilepas-pasang sesuai kenyamanan ya!',
                    ],
                ],
            ],
            [
                'category_slug' => 'helm-goggles',
                'name' => 'Helm Trail Alpinestars Supertech S-M8 Carbon Look',
                'slug' => 'helm-trail-alpinestars-supertech-sm8',
                'price' => 1850000,
                'stock' => 6,
                'description' => "Helm motocross dengan cangkang komposit berkepadatan tinggi yang dirancang untuk memberikan perlindungan benturan optimal pada kecepatan tinggi.\n\nFitur Utama:\n- Visor dengan sistem paten pelepasan otomatis saat insiden benturan untuk mengurangi trauma leher.\n- Sistem ventilasi 19 saluran udara intake dan exhaust.\n- Busa pipi anti-bakteri dan emergency cheek pad release system.\n- Bersertifikasi DOT dan SNI.",
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=800&auto=format&fit=crop&q=80', 'is_primary' => true],
                ],
                'variants' => [
                    ['name' => 'Ukuran', 'value' => 'M (57-58 cm)', 'additional_price' => 0, 'stock' => 2, 'sku' => 'AST-SM8-M'],
                    ['name' => 'Ukuran', 'value' => 'L (59-60 cm)', 'additional_price' => 0, 'stock' => 3, 'sku' => 'AST-SM8-L'],
                    ['name' => 'Ukuran', 'value' => 'XL (61-62 cm)', 'additional_price' => 0, 'stock' => 1, 'sku' => 'AST-SM8-XL'],
                ],
                'marketplace' => [
                    ['marketplace' => 'shopee', 'url' => 'https://shopee.co.id/search?keyword=reyxshop+helm+alpinestars'],
                    ['marketplace' => 'lazada', 'url' => 'https://www.lazada.co.id/catalog/?q=reyxshop+helm+alpinestars'],
                ],
                'reviews' => [
                    [
                        'customer_name' => 'Rian Hidayat',
                        'rating' => 5,
                        'content' => 'Helm sangat ringan dan sirkulasi udaranya mantap, kacamata goggle pas masuk tanpa mentok.',
                        'reply' => 'Terima kasih atas ulasannya Mas Rian. Helm Alpinestars S-M8 memang dirancang untuk kenyamanan jangka panjang.',
                    ],
                ],
                'questions' => [
                    [
                        'customer_name' => 'Kurnia',
                        'question' => 'Apakah muat dipasang goggle 100% Armega?',
                        'answer' => 'Sangat cocok Mas Kurnia, eyeport luas didesain pas untuk goggle berdimensi besar seperti 100% Armega.',
                    ],
                ],
            ],
            [
                'category_slug' => 'helm-goggles',
                'name' => 'Goggle 100% Armega HiPER Lens Anti-Fog',
                'slug' => 'goggle-100-armega-hiper-lens',
                'price' => 625000,
                'stock' => 18,
                'description' => 'Lensa Ultra HD berdefinisi tinggi yang meningkatkan kontras tekstur tanah dan bebatuan di trek balap.',
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=800&auto=format&fit=crop&q=80', 'is_primary' => true],
                ],
                'variants' => [
                    ['name' => 'Warna Lensa', 'value' => 'Mirror Red HiPER', 'additional_price' => 0, 'stock' => 7, 'sku' => 'ARM-RED'],
                    ['name' => 'Warna Lensa', 'value' => 'Smoke Tint Silver', 'additional_price' => 0, 'stock' => 6, 'sku' => 'ARM-SMK'],
                ],
                'marketplace' => [
                    ['marketplace' => 'shopee', 'url' => 'https://shopee.co.id/search?keyword=reyxshop+goggle+100'],
                    ['marketplace' => 'lazada', 'url' => 'https://www.lazada.co.id/catalog/?q=reyxshop+goggle+100'],
                ],
                'reviews' => [],
                'questions' => [],
            ],
            [
                'category_slug' => 'sarung-tangan-boots',
                'name' => 'Boots Off-Road Gaerne SG-12 Enduro Protection',
                'slug' => 'boots-off-road-gaerne-sg12',
                'price' => 3450000,
                'stock' => 5,
                'description' => 'Sepatu boots motocross legendaris dengan sistem engsel Dual Stage Pivot buatan Italia untuk keamanan ligamen dan ankle terbaik.',
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&auto=format&fit=crop&q=80', 'is_primary' => true],
                ],
                'variants' => [
                    ['name' => 'Ukuran Sepatu', 'value' => 'Size 41', 'additional_price' => 0, 'stock' => 1, 'sku' => 'GRN-41'],
                    ['name' => 'Ukuran Sepatu', 'value' => 'Size 42', 'additional_price' => 0, 'stock' => 2, 'sku' => 'GRN-42'],
                    ['name' => 'Ukuran Sepatu', 'value' => 'Size 43', 'additional_price' => 0, 'stock' => 1, 'sku' => 'GRN-43'],
                ],
                'marketplace' => [
                    ['marketplace' => 'shopee', 'url' => 'https://shopee.co.id/search?keyword=reyxshop+gaerne+sg12'],
                    ['marketplace' => 'lazada', 'url' => 'https://www.lazada.co.id/catalog/?q=reyxshop+gaerne+sg12'],
                ],
                'reviews' => [],
                'questions' => [],
            ],
            [
                'category_slug' => 'body-protector',
                'name' => 'Body Protector Thor Guardian Roost Deflector',
                'slug' => 'body-protector-thor-guardian',
                'price' => 890000,
                'stock' => 9,
                'description' => 'Rompi pelindung dada dan punggung dari lontaran batu dan benturan keras.',
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?w=800&auto=format&fit=crop&q=80', 'is_primary' => true],
                ],
                'variants' => [
                    ['name' => 'Ukuran', 'value' => 'M/L Dewasa', 'additional_price' => 0, 'stock' => 5, 'sku' => 'THR-ML'],
                    ['name' => 'Ukuran', 'value' => 'XL/2XL Dewasa', 'additional_price' => 0, 'stock' => 4, 'sku' => 'THR-XL'],
                ],
                'marketplace' => [
                    ['marketplace' => 'shopee', 'url' => 'https://shopee.co.id/search?keyword=reyxshop+thor+guardian'],
                    ['marketplace' => 'lazada', 'url' => 'https://www.lazada.co.id/catalog/?q=reyxshop+thor+guardian'],
                ],
                'reviews' => [],
                'questions' => [],
            ],
            [
                'category_slug' => 'parts-aksesoris',
                'name' => 'Tas Hidropack Enduro Acerbis Aqua 2L Water Bladder',
                'slug' => 'tas-hidropack-acerbis-aqua-2l',
                'price' => 380000,
                'stock' => 22,
                'description' => 'Tas punggung hidrasi tahan air dengan kompartemen botol minum dan kantung alat darurat di jalur trabas.',
                'images' => [
                    ['path' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&auto=format&fit=crop&q=80', 'is_primary' => true],
                ],
                'variants' => [
                    ['name' => 'Warna', 'value' => 'Black-Orange KTM Style', 'additional_price' => 0, 'stock' => 8, 'sku' => 'ACB-OR'],
                    ['name' => 'Warna', 'value' => 'Black-Fluo Green', 'additional_price' => 0, 'stock' => 8, 'sku' => 'ACB-GR'],
                ],
                'marketplace' => [
                    ['marketplace' => 'shopee', 'url' => 'https://shopee.co.id/search?keyword=reyxshop+acerbis+hidropack'],
                    ['marketplace' => 'lazada', 'url' => 'https://www.lazada.co.id/catalog/?q=reyxshop+acerbis+hidropack'],
                ],
                'reviews' => [],
                'questions' => [],
            ],
        ];

        foreach ($productsData as $pData) {
            $cat = $categories[$pData['category_slug']] ?? null;
            if (! $cat) {
                continue;
            }

            $product = Product::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'category_id' => $cat->id,
                    'name' => $pData['name'],
                    'price' => $pData['price'],
                    'stock' => $pData['stock'],
                    'description' => $pData['description'],
                    'is_active' => true,
                ]
            );

            // Images
            foreach ($pData['images'] as $idx => $img) {
                ProductImage::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'image_path' => $img['path'],
                    ],
                    [
                        'sort_order' => $idx,
                        'is_primary' => $img['is_primary'],
                        'alt_text' => $product->name,
                    ]
                );
            }

            // Variants
            foreach ($pData['variants'] as $var) {
                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'sku' => $var['sku'],
                    ],
                    [
                        'name' => $var['name'],
                        'value' => $var['value'],
                        'additional_price' => $var['additional_price'],
                        'stock' => $var['stock'],
                        'is_active' => true,
                    ]
                );
            }

            // Marketplace links
            foreach ($pData['marketplace'] as $mp) {
                MarketplaceLink::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'marketplace' => $mp['marketplace'],
                    ],
                    [
                        'url' => $mp['url'],
                        'is_active' => true,
                    ]
                );
            }

            // Reviews & Replies
            foreach ($pData['reviews'] as $revData) {
                // Create or get customer user for this review
                $customer = User::firstOrCreate(
                    ['email' => strtolower(str_replace([' ', '(', ')'], ['', '', ''], $revData['customer_name'])).'@customer.test'],
                    [
                        'name' => $revData['customer_name'],
                        'password' => bcrypt('password'),
                        'email_verified_at' => now(),
                    ]
                );

                $review = Review::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'user_id' => $customer->id,
                    ],
                    [
                        'rating' => $revData['rating'],
                        'content' => $revData['content'],
                        'status' => 'approved',
                    ]
                );

                if (! empty($revData['reply'])) {
                    ReviewReply::updateOrCreate(
                        ['review_id' => $review->id],
                        [
                            'user_id' => $admin->id,
                            'content' => $revData['reply'],
                        ]
                    );
                }
            }

            // Q&A
            foreach ($pData['questions'] as $qData) {
                // Create or get customer user for this question
                $customer = User::firstOrCreate(
                    ['email' => strtolower(str_replace([' ', '(', ')'], ['', '', ''], $qData['customer_name'])).'@customer.test'],
                    [
                        'name' => $qData['customer_name'],
                        'password' => bcrypt('password'),
                        'email_verified_at' => now(),
                    ]
                );

                $question = ProductQuestion::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'user_id' => $customer->id,
                        'question' => $qData['question'],
                    ],
                    [
                        'status' => 'answered',
                    ]
                );

                if (! empty($qData['answer'])) {
                    QuestionAnswer::updateOrCreate(
                        ['question_id' => $question->id],
                        [
                            'user_id' => $admin->id,
                            'answer' => $qData['answer'],
                        ]
                    );
                }
            }
        }
    }
}
