<?php

namespace App\Providers;

use App\Models\QuestionAnswer;
use App\Observers\QuestionAnswerObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        QuestionAnswer::observe(QuestionAnswerObserver::class);
    }
}
