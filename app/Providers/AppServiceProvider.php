<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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
        Gate::define('viewFilament', function ($user) {
            return $user->hasAnyRole(['admin', 'operator']);
        });
        // Ensure default roles exist
        if (Schema::hasTable('roles')) {
            Role::firstOrCreate(['name' => 'admin']);
            Role::firstOrCreate(['name' => 'operator']);
            Role::firstOrCreate(['name' => 'customer']);
        }

    }
}
