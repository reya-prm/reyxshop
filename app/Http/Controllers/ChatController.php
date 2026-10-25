<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatConversation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Get or initialize conversation messages for a customer/guest.
     */
    public function getMessages(Request $request): JsonResponse
    {
        // Only authenticated users can access
        if (! $request->user()) {
            abort(403, 'Login required');
        }

        $conversation = ChatConversation::firstOrCreate(
            ['user_id' => $request->user()->id],
            [
                'status' => 'open',
                'last_message_at' => now(),
            ]
        );

        $messages = $conversation->messages()
            ->select(['id', 'sender_type', 'message', 'created_at'])
            ->orderBy('created_at')
            ->get();

        return response()->json([
            'conversation_id' => $conversation->id,
            'messages' => $messages,
        ]);
    }

    /**
     * Send a customer chat message.
     */
    public function sendMessage(Request $request): JsonResponse
    {
        // Ensure authenticated user
        if (! $request->user()) {
            abort(403, 'Login required');
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'min:1', 'max:2000'],
        ]);

        $conversation = ChatConversation::firstOrCreate(
            ['user_id' => $request->user()->id],
            [
                'status' => 'open',
                'last_message_at' => now(),
            ]
        );

        DB::beginTransaction();
        try {
            $message = $conversation->messages()->create([
                'user_id' => $request->user()->id,
                'sender_type' => 'customer',
                'message' => $validated['message'],
            ]);

            $conversation->update(['last_message_at' => now()]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim pesan chat.',
            ], 500);
        }

        // Broadcast to private channel
        try {
            event(new MessageSent($message));
        } catch (\Throwable $e) {
            // Continue gracefully if websocket server is offline
        }

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'conversation_id' => $conversation->id,
        ], 201);
    }
}
