<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\StoreSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the official customer-facing ReyxShop homepage using real database data.
     */
    public function index(Request $request): View
    {
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

        // Store Settings from DB
        $storeSettings = [
            'store_name' => StoreSetting::getValue('store_name', 'ReyxShop Off-Road & Motocross Gear'),
            'is_open' => StoreSetting::getValue('is_open', true),
            'status_label' => StoreSetting::getValue('status_label', 'Buka Hari Ini'),
            'status_notice' => StoreSetting::getValue('status_notice', 'Toko buka pukul 08:30 - 18:00 WIB. Pengiriman cepat setiap hari kerja!'),
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
