<?php

use App\Models\ChatConversation;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

test('review submission commits data within database transaction', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'Luar biasa bagus!',
    ]);

    $response->assertRedirect(route('products.show', $product->slug));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reviews', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'rating' => 5,
        'content' => 'Luar biasa bagus!',
    ]);
});

test('question submission commits data within database transaction', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->post(route('products.questions.store', $product->slug), [
        'question' => 'Apakah ukuran XL ready?',
    ]);

    $response->assertRedirect(route('products.show', $product->slug));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('product_questions', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'question' => 'Apakah ukuran XL ready?',
    ]);
});

test('chat message sending commits message and updates conversation within transaction', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->postJson(route('chat.send'), [
        'message' => 'Halo admin, mau tanya stok helm.',
    ]);

    $response->assertStatus(201);
    $response->assertJsonPath('status', 'success');

    $this->assertDatabaseHas('chat_messages', [
        'user_id' => $user->id,
        'sender_type' => 'customer',
        'message' => 'Halo admin, mau tanya stok helm.',
    ]);

    $conversation = ChatConversation::where('user_id', $user->id)->first();
    expect($conversation)->not->toBeNull();
    expect($conversation->last_message_at)->not->toBeNull();
});

test('product updateStockViaProcedure adjusts stock safely and prevents negative stock', function () {
    $product = Product::factory()->create([
        'stock' => 10,
    ]);

    // Decrease stock by 3
    $product->updateStockViaProcedure(-3);
    expect($product->fresh()->stock)->toBe(7);

    // Increase stock by 5
    $product->updateStockViaProcedure(5);
    expect($product->fresh()->stock)->toBe(12);

    // Decrease stock by more than available (should floor at 0)
    $product->updateStockViaProcedure(-20);
    expect($product->fresh()->stock)->toBe(0);
});

test('product getDbFinalPrice returns numeric final price', function () {
    $product = Product::factory()->create([
        'price' => 250000.00,
    ]);

    expect($product->getDbFinalPrice())->toBe(250000.00);
});

test('database transaction rollback works when exception thrown inside transaction', function () {
    $product = Product::factory()->create(['stock' => 15]);

    try {
        DB::beginTransaction();
        $product->update(['stock' => 99]);
        throw new Exception('Simulated failure during checkout/update');
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
    }

    // Must be rolled back to original 15
    expect($product->fresh()->stock)->toBe(15);
});
