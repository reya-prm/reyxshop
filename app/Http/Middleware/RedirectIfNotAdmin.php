<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (! $user) {
            return redirect('/login');
        }

        if (! $user->canAccessPanel(Filament::getDefaultPanel())) {
            abort(403, 'Akses ditolak. Halaman admin hanya diperuntukkan bagi Administrator dan Operator.');
        }

        return $next($request);
    }
}
