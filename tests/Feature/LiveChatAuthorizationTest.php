<?php

use App\Models\User;
use App\Models\ChatConversation;
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

    // A sends a message (creates conversation)
    $this->actingAs($customerA);
    $sendA = $this->postJson(route('chat.send'), ['message' => 'Message from A'])->assertCreated();
    $convIdA = $sendA->json('conversation_id');

    // B sends a message (different conversation)
    $this->actingAs($customerB);
    $sendB = $this->postJson(route('chat.send'), ['message' => 'Message from B'])->assertCreated();
    $convIdB = $sendB->json('conversation_id');

    $this->assertNotEquals($convIdA, $convIdB);

    // A fetches its own messages
    $this->actingAs($customerA);
    $responseA = $this->getJson(route('chat.messages'));
    $responseA->assertOk();
    $jsonA = $responseA->json();
    $this->assertEquals($convIdA, $jsonA['conversation_id']);
    $this->assertIsArray($jsonA['messages']);

    // B fetches its own messages
    $this->actingAs($customerB);
    $responseB = $this->getJson(route('chat.messages'));
    $responseB->assertOk();
    $jsonB = $responseB->json();
    $this->assertEquals($convIdB, $jsonB['conversation_id']);
    $this->assertIsArray($jsonB['messages']);

    // Ensure different conversation IDs
    $this->assertNotEquals($convIdA, $convIdB);
});
