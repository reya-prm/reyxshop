<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('guest cannot access chat messages or send messages', function () {
    $this->getJson(route('chat.messages'))->assertUnauthorized();
    $this->postJson(route('chat.send'), ['message' => 'Hello'])->assertUnauthorized();
});

test('verified customer can fetch their conversation and send message', function () {
    Role::firstOrCreate(['name' => 'customer']);
    $user = User::factory()->create();
    $user->assignRole('customer');
    $user->markEmailAsVerified();

    $this->actingAs($user);

    $response = $this->getJson(route('chat.messages'));
    $response->assertSuccessful()
        ->assertJsonStructure(['conversation_id', 'messages']);

    $sendResponse = $this->postJson(route('chat.send'), [
        'message' => 'Halo admin, tolong bantu pesanan saya.',
    ]);

    $sendResponse->assertStatus(201)
        ->assertJsonPath('status', 'success');

    // Verify a message was stored for this user
    $this->assertDatabaseHas('chat_messages', [
        'user_id' => $user->id,
        'message' => 'Halo admin, tolong bantu pesanan saya.',
    ]);
});

test('message exceeding max length is rejected', function () {
    Role::firstOrCreate(['name' => 'customer']);
    $user = User::factory()->create();
    $user->assignRole('customer');
    $user->markEmailAsVerified();

    $this->actingAs($user);

    $longMessage = str_repeat('a', 2001);

    $this->postJson(route('chat.send'), [
        'message' => $longMessage,
    ])->assertUnprocessable();
});
