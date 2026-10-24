<?php

use App\Models\Product;
use App\Models\User;

test('guest cannot submit review', function () {
    $product = Product::factory()->create();

    $response = $this->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'Great product!',
    ]);

    $response->assertRedirect(route('login'));
});

test('authenticated user without email verification cannot submit review', function () {
    $user = User::factory()->unverified()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'Great product!',
    ]);

    $response->assertStatus(403);
});

test('verified user can submit review', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'Great product with excellent quality!',
    ]);

    $response->assertRedirect(route('products.show', $product->slug));
    expect($product->reviews()->where('user_id', $user->id)->exists())->toBeTrue();
});

test('user cannot review same product twice', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $product = Product::factory()->create();

    // First review
    $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'First review',
    ]);

    // Second review (should fail)
    $response = $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'rating' => 4,
        'content' => 'Second review',
    ]);

    $response->assertSessionHasErrors('review');
    expect($product->reviews()->count())->toBe(1);
});

test('review requires valid rating', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'rating' => 6, // Invalid: out of range
        'content' => 'Great product!',
    ]);

    $response->assertSessionHasErrors('rating');
});

test('guest cannot submit question', function () {
    $product = Product::factory()->create();

    $response = $this->post(route('products.questions.store', $product->slug), [
        'question' => 'What size is this?',
    ]);

    $response->assertRedirect(route('login'));
});

test('verified user can submit question', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('products.questions.store', $product->slug), [
        'question' => 'What size is this product?',
    ]);

    $response->assertRedirect(route('products.show', $product->slug));
    expect($product->questions()->where('user_id', $user->id)->exists())->toBeTrue();
});

test('user_id is taken from auth not request', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);
    $otherUser = User::factory()->create();
    $product = Product::factory()->create();

    // Attempt to spoof user_id
    $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'user_id' => $otherUser->id, // Attacker trying to fake user_id
        'rating' => 5,
        'content' => 'Spoofed review',
    ]);

    expect($product->reviews()->where('user_id', $user->id)->exists())->toBeTrue();
    expect($product->reviews()->where('user_id', $otherUser->id)->exists())->toBeFalse();
});
