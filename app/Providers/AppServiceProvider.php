<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        // Register SEO facade alias for Blade templates
        if (!class_exists('SEO')) {
            class_alias(\Artesaos\SEOTools\Facades\SEOTools::class, 'SEO');
        }
    }
}
