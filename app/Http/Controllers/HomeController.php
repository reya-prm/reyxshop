<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the official customer-facing ReyxShop homepage using real database data.
     */
    public function index(Request $request): View
    {
        SEOMeta::setTitle('ReyxShop Kids – Pusat Pakaian Anak Berkualitas');
        SEOMeta::setDescription('Pusat belanja online pakaian anak berkualitas, modis, dan nyaman di ReyxShop Kids.');
        OpenGraph::setTitle('ReyxShop Kids – Pusat Pakaian Anak Berkualitas');
        OpenGraph::setDescription('Pusat belanja online pakaian anak berkualitas, modis, dan nyaman di ReyxShop Kids.');

        $search = $request->query('search');
        $selectedCategory = $request->query('category');

        // Categories from DB with products count
        $categories = Category::active()
            ->withCount(['products' => function ($query) {
                $query->where('is_active', true);
            }])
            ->get();

        // Products query with eager loading to prevent N+1 queries
        $productsQuery = Product::active()
            ->with([
                'category',
                'images',
                'variants',
                'marketplaceLinks',
                'approvedReviews',
            ]);

        if ($search) {
            $productsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($selectedCategory) {
            $productsQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        $featuredProducts = $productsQuery->latest()->take(12)->get();

        // Auto store status based on time (07:00 - 17:00 WIB)
        $currentHour = (int) now('Asia/Jakarta')->format('H');
        $isOpenNow = ($currentHour >= 7 && $currentHour < 17);
        $statusLabel = $isOpenNow ? 'Buka Sekarang' : 'Tutup';
        $statusNotice = $isOpenNow
            ? 'Toko buka pukul 07:00 - 17:00 WIB. Pengiriman same-day untuk order sebelum jam 15:00!'
            : 'Toko tutup. Buka kembali jam 07:00 WIB. Anda tetap bisa browsing dan chat akan dibalas saat toko buka.';

        // Store Settings from DB
        $storeSettings = [
            'store_name' => StoreSetting::getValue('store_name', 'ReyxShop Kids - Pakaian Anak Berkualitas'),
            'is_open' => $isOpenNow,
            'status_label' => $statusLabel,
            'status_notice' => $statusNotice,
            'whatsapp_number' => StoreSetting::getValue('whatsapp_number', '6281234567890'),
            'whatsapp_display' => StoreSetting::getValue('whatsapp_display', '+62 812-3456-7890'),
            'address' => StoreSetting::getValue('address', 'Jl. Jalur Trabas No. 49, Kawasan Motocross Arena, Indonesia'),
            'shopee_url' => StoreSetting::getValue('shopee_url', 'https://shopee.co.id'),
            'lazada_url' => StoreSetting::getValue('lazada_url', 'https://lazada.co.id'),
        ];

        // Active Banners from DB
        $banners = Banner::active()->get();

        return view('home', compact(
            'categories',
            'featuredProducts',
            'storeSettings',
            'banners',
            'search',
            'selectedCategory'
        ));
    }
}
