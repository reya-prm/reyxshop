<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Spatie\Permission\Models\Role;

test('guest cannot submit review or question', function () {
    $category = Category::create(['name' => 'Helm', 'slug' => 'helm']);
    $product = Product::create([
        'category_id' => $category->id,
        'name' => 'Helm Fox',
        'slug' => 'helm-fox',
        'price' => 500000,
        'stock' => 10,
    ]);

    $this->post(route('products.reviews.store', $product->slug), [
        'rating' => 5,
        'content' => 'Bagus sekali!',
    ])->assertRedirect(route('login'));

    $this->post(route('products.questions.store', $product->slug), [
        'question' => 'Apakah ada warna lain?',
    ])->assertRedirect(route('login'));
});

test('customer cannot access filament admin panel', function () {
    Role::firstOrCreate(['name' => 'customer']);
    $customer = User::factory()->create();
    $customer->assignRole('customer');
    $customer->markEmailAsVerified();

    $this->actingAs($customer);

    $this->get('/admin')->assertForbidden();
});

test('admin can access filament admin panel', function () {
    Role::firstOrCreate(['name' => 'admin']);
    $admin = User::factory()->create();
    $admin->assignRole('admin');
    $admin->markEmailAsVerified();

    // Test canAccessPanel method directly
    $panel = app(\Filament\Panel::class);
    expect($admin->canAccessPanel($panel))->toBeTrue();
});
