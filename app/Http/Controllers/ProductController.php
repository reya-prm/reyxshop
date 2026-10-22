<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductQuestion;
use App\Models\Review;
use App\Models\StoreSetting;
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

        return view('products.show', compact('product', 'relatedProducts', 'storeSettings'));
    }

    /**
     * Store customer review in database with validation.
     */
    public function storeReview(Request $request, string $slug): RedirectResponse
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $product->reviews()->create([
            'customer_name' => $validated['customer_name'],
            'rating' => $validated['rating'],
            'content' => $validated['content'],
            'status' => 'approved', // Auto-approved for verified catalog experience
        ]);

        return redirect()->route('products.show', $product->slug)
            ->with('success', 'Ulasan Anda berhasil dikirim dan ditayangkan. Terima kasih atas feedback-nya!');
    }

    /**
     * Store customer question (Q&A) in database with validation.
     */
    public function storeQuestion(Request $request, string $slug): RedirectResponse
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'question' => ['required', 'string', 'min:5', 'max:1000'],
        ]);

        $product->questions()->create([
            'customer_name' => $validated['customer_name'],
            'question' => $validated['question'],
            'status' => 'pending',
        ]);

        return redirect()->route('products.show', $product->slug)
            ->with('success', 'Pertanyaan Anda telah kami terima! Admin akan segera memberikan jawaban.');
    }
}
