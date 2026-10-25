<?php

use App\Models\ChatConversation;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'operator']);
    Role::firstOrCreate(['name' => 'customer']);
});

test('chat conversation model has user and messages relationships for admin chat', function () {
    $customer = User::factory()->create();
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $conversation = ChatConversation::create([
        'user_id' => $customer->id,
        'status' => 'open',
        'last_message_at' => now(),
    ]);

    expect($conversation->user)->not->toBeNull();
    expect($conversation->user->id)->toBe($customer->id);

    // Admin replies
    $reply = $conversation->messages()->create([
        'user_id' => $admin->id,
        'sender_type' => 'admin',
        'message' => 'Halo dari admin!',
    ]);

    expect($reply->id)->not->toBeNull();
    expect($reply->sender_type)->toBe('admin');
    expect($reply->user_id)->toBe($admin->id);
    expect($conversation->messages()->count())->toBe(1);
});

test('admin can access dashboard and all resource pages', function () {
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $routes = [
        '/admin',
        '/admin/products',
        '/admin/products/create',
        '/admin/categories',
        '/admin/banners',
        '/admin/store-settings',
        '/admin/reviews',
        '/admin/product-questions',
        '/admin/chat-conversations',
    ];

    foreach ($routes as $url) {
        $response = $this->actingAs($admin)->get($url);
        $response->assertSuccessful();
    }
});

test('regular customer account cannot access admin panel and receives forbidden 403', function () {
    $customer = User::factory()->create([
        'role' => 'customer',
    ]);
    $customer->assignRole('customer');

    $response = $this->actingAs($customer)->get('/admin');
    $response->assertForbidden();
});

test('review model has replies and reply relationships for admin responses', function () {
    $customer = User::factory()->create();
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $product = Product::factory()->create();

    $review = Review::create([
        'product_id' => $product->id,
        'user_id' => $customer->id,
        'rating' => 5,
        'content' => 'Produk mantap!',
        'status' => 'approved',
    ]);

    expect($review->replies())->not->toBeNull();
    expect($review->replies()->count())->toBe(0);

    // Admin replies
    $reply = $review->replies()->create([
        'user_id' => $admin->id,
        'content' => 'Terima kasih atas ulasannya!',
    ]);

    expect($reply->id)->not->toBeNull();
    expect($review->replies()->count())->toBe(1);
    expect($review->reply)->not->toBeNull();
    expect($review->reply->content)->toBe('Terima kasih atas ulasannya!');
});

test('customer can submit multiple reviews across different products without hitting too many requests', function () {
    $customer = User::factory()->create();
    $products = Product::factory()->count(5)->create();

    foreach ($products as $p) {
        $response = $this->actingAs($customer)->post(route('products.reviews.store', $p->slug), [
            'rating' => 5,
            'content' => 'Review for '.$p->name,
        ]);

        $response->assertRedirect(route('products.show', $p->slug));
        $response->assertSessionHas('success');
    }

    expect($customer->reviews()->count())->toBe(5);
});

test('customer sees error notification when attempting duplicate review on same product', function () {
    $customer = User::factory()->create();
    $product = Product::factory()->create();

    // First review
    $this->actingAs($customer)->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'Review pertama',
    ]);

    // Second review on same product
    $response = $this->actingAs($customer)->post(route('products.reviews.store', $product->slug), [
        'rating' => 4,
        'content' => 'Review kedua',
    ]);

    $response->assertRedirect(route('products.show', $product->slug));
    $response->assertSessionHasErrors('review');
});
