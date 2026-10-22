<?php

namespace App\Http\Controllers;

use App\Models\ChatConversation;
use App\Models\ChatMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * Get or initialize conversation messages for a customer/guest.
     */
    public function getMessages(Request $request): JsonResponse
    {
        $guestToken = $request->query('guest_token') ?: session()->get('chat_guest_token');

        if (!$guestToken) {
            $guestToken = Str::uuid()->toString();
            session()->put('chat_guest_token', $guestToken);
        }

        $conversation = ChatConversation::firstOrCreate(
            ['guest_token' => $guestToken],
            [
                'customer_name' => $request->query('customer_name') ?: 'Guest Rider',
                'status' => 'open',
                'last_message_at' => now(),
            ]
        );

        $messages = $conversation->messages()
            ->select(['id', 'sender_type', 'message', 'created_at'])
            ->get();

        return response()->json([
            'guest_token' => $guestToken,
            'conversation_id' => $conversation->id,
            'messages' => $messages,
        ]);
    }

    /**
     * Send a customer chat message.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
            'guest_token' => ['nullable', 'string'],
            'customer_name' => ['nullable', 'string', 'max:100'],
        ]);

        $guestToken = ($validated['guest_token'] ?? null) ?: session()->get('chat_guest_token');
        if (!$guestToken) {
            $guestToken = Str::uuid()->toString();
            session()->put('chat_guest_token', $guestToken);
        }

        $conversation = ChatConversation::firstOrCreate(
            ['guest_token' => $guestToken],
            [
                'customer_name' => $validated['customer_name'] ?? 'Guest Rider',
                'status' => 'open',
                'last_message_at' => now(),
            ]
        );

        $message = $conversation->messages()->create([
            'sender_type' => 'customer',
            'message' => $validated['message'],
        ]);

        $conversation->update(['last_message_at' => now()]);

        // Auto-reply bot greeting for immediate response if this is first customer message
        if ($conversation->messages()->count() === 1) {
            $conversation->messages()->create([
                'sender_type' => 'system',
                'message' => 'Terima kasih telah menghubungi ReyxShop! Admin kami sedang mengecek pesan Anda. Untuk respon super cepat, Anda juga bisa langsung chat kami via WhatsApp di nomor resmi toko.',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'conversation_id' => $conversation->id,
        ], 201);
    }
}
