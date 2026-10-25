<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

test('guest cannot send chat message', function () {
    $this->postJson(route('chat.send'), ['message' => 'Hello'])->assertUnauthorized();
});

test('customer can send and retrieve own messages, isolated from others', function () {
    Role::firstOrCreate(['name' => 'customer']);
    $customerA = User::factory()->create();
    $customerA->assignRole('customer');
    $customerA->markEmailAsVerified();

    $customerB = User::factory()->create();
    $customerB->assignRole('customer');
    $customerB->markEmailAsVerified();

    // A sends a message
    $this->actingAs($customerA);
    $sendA = $this->postJson(route('chat.send'), ['message' => 'Message from A'])->assertCreated();

    // B sends a message
    $this->actingAs($customerB);
    $sendB = $this->postJson(route('chat.send'), ['message' => 'Message from B'])->assertCreated();

    // A fetches its own messages
    $this->actingAs($customerA);
    $responseA = $this->getJson(route('chat.messages'))->assertOk();
    $convA = $responseA->json('conversation_id');
    $this->assertIsInt($convA);
    $this->assertIsArray($responseA->json('messages'));
    $this->assertCount(1, $responseA->json('messages')); // Only A's message

    // B fetches its own messages
    $this->actingAs($customerB);
    $responseB = $this->getJson(route('chat.messages'))->assertOk();
    $convB = $responseB->json('conversation_id');
    $this->assertIsInt($convB);
    $this->assertIsArray($responseB->json('messages'));
    $this->assertCount(1, $responseB->json('messages')); // Only B's message

    // Ensure different conversations
    $this->assertNotEquals($convA, $convB);
});
