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

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Interaksi Produk (Reviews & Q&A) - rate limited to prevent spam
    Route::post('/products/{slug}/reviews', [ProductController::class, 'storeReview'])
        ->middleware('throttle:3,10')
        ->name('products.reviews.store');
    Route::post('/products/{slug}/questions', [ProductController::class, 'storeQuestion'])
        ->middleware('throttle:5,10')
        ->name('products.questions.store');

    // Live Chat API endpoints
    Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])
        ->middleware('throttle:10,1')
        ->name('chat.send');
});

// SEO & Search Engine routes (placeholder - controller not present)
// Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
// Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

require __DIR__.'/auth.php';
