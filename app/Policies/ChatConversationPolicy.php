<?php

namespace App\Policies;

use App\Models\ChatConversation;
use App\Models\User;

class ChatConversationPolicy
{
    /**
     * Admin and operator can view all conversations.
     * Customer can only view their own.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['admin', 'operator']);
    }

    /**
     * User can view conversation if they own it or have admin/operator role.
     */
    public function view(User $user, ChatConversation $chatConversation): bool
    {
        // Owner
        if ($chatConversation->user_id === $user->id) {
            return true;
        }

        // Admin/operator
        return $user->hasRole(['admin', 'operator']);
    }

    /**
     * Customer or admin can create conversation.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Only admin/operator can update conversation metadata (assign, close).
     */
    public function update(User $user, ChatConversation $chatConversation): bool
    {
        return $user->hasRole(['admin', 'operator']);
    }

    /**
     * Only admin can delete.
     */
    public function delete(User $user, ChatConversation $chatConversation): bool
    {
        return $user->hasRole('admin');
    }
}
