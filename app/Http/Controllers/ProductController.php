<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductQuestionRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\StoreSetting;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the full catalog listing with database queries, filtering, and search.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $selectedCategory = $request->query('category');

        $categories = Category::active()->orderBy('name')->get();

        $query = Product::active()
            ->with(['category', 'images', 'variants', 'marketplaceLinks', 'approvedReviews']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($selectedCategory) {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        $products = $query->latest()->paginate(9)->withQueryString();

        // SEO meta tags for catalog page
        SEOMeta::setTitle('Katalog Produk – '.config('app.name'));
        SEOMeta::setDescription('Jelajahi semua produk off‑road, motor, dan aksesoris di ReyxShop. Filter kategori, cari, baca ulasan, beli via marketplace.');
        SEOMeta::addKeyword(['off‑road', 'motor', 'helm', 'baju', 'sparepart', 'competizione', 'apex', 'fox', 'racing']);
        OpenGraph::setTitle('Katalog Produk ReyxShop');
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');

        return view('products.index', compact('products', 'categories', 'search', 'selectedCategory'));
    }

    /**
     * Display detailed product page with full relations from database.
     */
    public function show(string $slug): View
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'category',
                'images',
                'variants',
                'marketplaceLinks',
                'approvedReviews.reply',
                'answeredQuestions.answer',
            ])
            ->firstOrFail();

        // SEO meta for product detail page
        SEOMeta::setTitle($product->name.' – ReyxShop');
        SEOMeta::setDescription(substr(strip_tags($product->description ?? ''), 0, 150));
        SEOMeta::setCanonical(url()->current());
        SEOMeta::addKeyword(['off‑road', $product->category->name ?? 'product', $product->name]);
        OpenGraph::setTitle($product->name);
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        if ($product->images->isNotEmpty()) {
            OpenGraph::addImage($product->image_url);
        }
        OpenGraph::addProperty('type', 'product');

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with('images')
            ->take(3)
            ->get();

        $storeSettings = [
            'whatsapp_number' => StoreSetting::getValue('whatsapp_number', '6281234567890'),
            'whatsapp_display' => StoreSetting::getValue('whatsapp_display', '+62 812-3456-7890'),
            'shopee_url' => StoreSetting::getValue('shopee_url', 'https://shopee.co.id'),
            'lazada_url' => StoreSetting::getValue('lazada_url', 'https://lazada.co.id'),
        ];

        $userReview = auth()->check()
            ? $product->reviews()->where('user_id', auth()->id())->first()
            : null;

        return view('products.show', compact('product', 'relatedProducts', 'storeSettings', 'userReview'));
    }

    /**
     * Store customer review in database with validation.
     */
    public function storeReview(StoreReviewRequest $request, string $slug): RedirectResponse
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $validated = $request->validated();

        // Check if user already reviewed this product (unique constraint)
        if ($product->reviews()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('products.show', $product->slug)
                ->withErrors(['review' => 'Anda sudah memberikan ulasan untuk produk ini.']);
        }

        $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'status' => 'approved', // Auto-approve, no moderation
        ]);

        return redirect()->route('products.show', $product->slug)
            ->with('success', 'Ulasan Anda berhasil dikirim. Terima kasih!');
    }

    /**
     * Store customer question (Q&A) in database with validation.
     */
    public function storeQuestion(StoreProductQuestionRequest $request, string $slug): RedirectResponse
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $validated = $request->validated();

        $product->questions()->create([
            'user_id' => auth()->id(),
            'question' => $validated['question'],
            'status' => 'pending',
        ]);

        return redirect()->route('products.show', $product->slug)
            ->with('success', 'Pertanyaan Anda telah kami terima! Admin akan segera memberikan jawaban.');
    }
}
