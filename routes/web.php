<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — ReyxShop Official Storefront
|--------------------------------------------------------------------------
*/

// Entry point customer-facing Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog & Detail Produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Interaksi Produk (Reviews & Q&A)
Route::post('/products/{slug}/reviews', [ProductController::class, 'storeReview'])->name('products.reviews.store');
Route::post('/products/{slug}/questions', [ProductController::class, 'storeQuestion'])->name('products.questions.store');

// Live Chat API endpoints
Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

// SEO & Search Engine routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');
