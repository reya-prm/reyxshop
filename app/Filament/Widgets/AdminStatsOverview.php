<?php

namespace App\Filament\Widgets;

use App\Models\ChatConversation;
use App\Models\Product;
use App\Models\Review;
use App\Models\ProductQuestion;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class AdminStatsOverview extends Widget
{
    protected static string $view = 'filament.widgets.admin-stats-overview';

    public function getStats(): array
    {
        return [
            'pending_reviews' => Review::where('status', 'pending')->count(),
            'pending_questions' => ProductQuestion::where('status', 'pending')->count(),
            'unread_chats' => ChatConversation::where('status', 'open')
                ->whereNotNull('last_message_at')
                ->count(),
            'low_stock' => Product::where('stock', '<', 5)->count(),
            'out_of_stock' => Product::where('stock', '=', 0)->count(),
        ];
    }
}
