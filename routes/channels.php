<?php

use App\Models\ChatConversation;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('private-chat.{conversationId}', function ($user, $conversationId) {
    // User must be owner of conversation or have admin/operator role
    $conv = ChatConversation::find($conversationId);
    if (! $conv) {
        return false;
    }
    // Owner
    if ($conv->user_id && $user->id === $conv->user_id) {
        return true;
    }

    // Admin/operator can listen to any
    return $user->hasRole(['admin', 'operator']);
});
