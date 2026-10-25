<?php

use App\Models\Category;
use App\Models\ChatConversation;
use App\Models\MarketplaceLink;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\StoreSetting;
use App\Models\User;

beforeEach(function () {
    StoreSetting::setValue('store_name', 'ReyxShop Off-Road Gear');
    StoreSetting::setValue('whatsapp_number', '6281234567890');
    StoreSetting::setValue('is_open', true);

    $this->category = Category::create([
        'name' => 'Jersey Motocross',
        'slug' => 'jersey-motocross',
        'description' => 'Jersey balap trabas',
        'is_active' => true,
    ]);

    $this->product = Product::create([
        'category_id' => $this->category->id,
        'name' => 'Jersey Fox Legion Enduro',
        'slug' => 'jersey-fox-legion-enduro',
        'price' => 450000,
        'stock' => 10,
        'description' => 'Jersey offroad bahan adem',
        'is_active' => true,
    ]);

    ProductImage::create([
        'product_id' => $this->product->id,
        'image_path' => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?w=800',
        'is_primary' => true,
        'sort_order' => 0,
    ]);

    ProductVariant::create([
        'product_id' => $this->product->id,
        'name' => 'Ukuran',
        'value' => 'L',
        'stock' => 5,
        'sku' => 'FX-L',
        'is_active' => true,
    ]);

    MarketplaceLink::create([
        'product_id' => $this->product->id,
        'marketplace' => 'shopee',
        'url' => 'https://shopee.co.id/product-123',
        'is_active' => true,
    ]);
});

test('homepage loads successfully with products and store status', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('ReyxShop');
    $response->assertSee('Jersey Motocross');
    $response->assertSee('Jersey Fox Legion Enduro');
    $response->assertSee('Rp 450.000');
});

test('products catalog page displays products and filters by category', function () {
    $response = $this->get('/products');

    $response->assertStatus(200);
    $response->assertSee('Jersey Fox Legion Enduro');

    // Filter category
    $filteredResponse = $this->get('/products?category=jersey-motocross');
    $filteredResponse->assertStatus(200);
    $filteredResponse->assertSee('Jersey Fox Legion Enduro');
});

test('product detail page displays product information, variants, and marketplace links', function () {
    $response = $this->get('/products/'.$this->product->slug);

    $response->assertStatus(200);
    $response->assertSee('Jersey Fox Legion Enduro');
    $response->assertSee('Ukuran: L');
    $response->assertSee('Buka Produk di Shopee Official');
});

test('customer can submit product review with validation', function () {
    $user = User::factory()->create();
    $user->markEmailAsVerified();

    $response = $this->actingAs($user)->post('/products/'.$this->product->slug.'/reviews', [
        'rating' => 5,
        'content' => 'Barang sangat bagus, jahitan rapi untuk trabas!',
    ]);

    $response->assertRedirect('/products/'.$this->product->slug);
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reviews', [
        'product_id' => $this->product->id,
        'user_id' => $user->id,
        'rating' => 5,
    ]);
});

test('guest user sees login prompt instead of review form', function () {
    $response = $this->get('/products/'.$this->product->slug);

    $response->assertStatus(200);
    $response->assertSee('Login untuk Menulis Ulasan');
    $response->assertDontSee('Kirim Ulasan');
    $response->assertDontSee('Anda sudah mengulas produk ini');
});

test('authenticated user who has not reviewed sees review form', function () {
    $user = User::factory()->create();
    $user->markEmailAsVerified();

    $response = $this->actingAs($user)->get('/products/'.$this->product->slug);

    $response->assertStatus(200);
    $response->assertSee('Kirim Ulasan');
    $response->assertDontSee('Login untuk Menulis Ulasan');
    $response->assertDontSee('Anda sudah mengulas produk ini');
});

test('authenticated user who already reviewed sees already reviewed message and their review', function () {
    $user = User::factory()->create();
    $user->markEmailAsVerified();

    Review::create([
        'product_id' => $this->product->id,
        'user_id' => $user->id,
        'rating' => 5,
        'content' => 'Produk original sangat mantap!',
        'status' => 'approved',
    ]);

    $response = $this->actingAs($user)->get('/products/'.$this->product->slug);

    $response->assertStatus(200);
    $response->assertSee('Anda sudah mengulas produk ini');
    $response->assertSee('Produk original sangat mantap!');
    $response->assertDontSee('Kirim Ulasan');
    $response->assertDontSee('Login untuk Menulis Ulasan');
});

test('customer can submit product question with validation', function () {
    $user = User::factory()->create();
    $user->markEmailAsVerified();

    $response = $this->actingAs($user)->post('/products/'.$this->product->slug.'/questions', [
        'question' => 'Apakah celananya anti air saat melewati sungai?',
    ]);

    $response->assertRedirect('/products/'.$this->product->slug);
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('product_questions', [
        'product_id' => $this->product->id,
        'user_id' => $user->id,
        'status' => 'pending',
    ]);
});

test('customer can send and retrieve live chat messages', function () {
    $user = User::factory()->create();
    $user->markEmailAsVerified();

    // 1. Send message
    $sendResponse = $this->actingAs($user)->postJson('/chat/send', [
        'message' => 'Halo admin, apakah produk ini ready?',
    ]);

    $sendResponse->assertStatus(201);
    $sendResponse->assertJsonPath('status', 'success');
    $conversationId = $sendResponse->json('conversation_id');

    // 2. Retrieve messages
    $messagesResponse = $this->actingAs($user)->getJson('/chat/messages');
    $messagesResponse->assertStatus(200);
    $messagesResponse->assertJsonStructure([
        'conversation_id',
        'messages',
    ]);
    // Verify conversation exists in DB and matches sent ID
    $dbConversationId = ChatConversation::where('user_id', $user->id)->value('id');
    $this->assertEquals($conversationId, $dbConversationId);
    $this->assertEquals($dbConversationId, $messagesResponse->json('conversation_id'));
});
