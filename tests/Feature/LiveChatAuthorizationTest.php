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

    // A fetches messages, should see only its own
    $this->actingAs($customerA);
    $this->getJson(route('chat.messages'))->assertJsonFragment(['conversation_id' => $convIdA])
        ->assertJsonMissing(['conversation_id' => $convIdB]);
});
