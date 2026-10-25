<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('All products in catalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),
            Stat::make('Total Categories', Category::count())
                ->description('Product categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info'),
            Stat::make('Active Products', Product::where('is_active', true)->count())
                ->description('Visible to customers')
                ->descriptionIcon('heroicon-m-eye')
                ->color('primary'),
            Stat::make('Total Reviews', Review::count())
                ->description('Customer reviews')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),
        ];
    }
}
