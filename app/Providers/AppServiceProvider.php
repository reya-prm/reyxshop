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
        // Filament panel access – admin & operator allowed, customer denied
        \Illuminate\Support\Facades\Gate::define('viewFilament', function ($user) {
            return $user->hasAnyRole(['admin', 'operator']);
        });
        // Ensure default roles exist
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'operator']);
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'customer']);

    }
}
