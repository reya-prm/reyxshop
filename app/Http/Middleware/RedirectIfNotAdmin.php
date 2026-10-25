<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        // Jika tidak login atau tidak dapat mengakses panel Filament
        if (! $user || ! $user->canAccessPanel(Filament::getDefaultPanel())) {
            return redirect('/login');
        }
        return $next($request);
    }
}
