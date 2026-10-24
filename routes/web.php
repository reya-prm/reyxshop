<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Interaksi Produk (Reviews & Q&A)
    Route::post('/products/{slug}/reviews', [ProductController::class, 'storeReview'])->name('products.reviews.store');
    Route::post('/products/{slug}/questions', [ProductController::class, 'storeQuestion'])->name('products.questions.store');

    // Live Chat API endpoints
    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
});

// SEO & Search Engine routes (placeholder - controller not present)
// Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
// Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

require __DIR__.'/auth.php';
