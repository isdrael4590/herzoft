<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForcePasswordChange
{
    /**
     * Rutas permitidas aunque el usuario deba cambiar su contraseña.
     */
    protected array $allowed = [
        'profile.edit',
        'profile.update.password',
        'logout',
    ];

    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->must_change_password) {
            $currentRoute = $request->route()?->getName();

            if (!in_array($currentRoute, $this->allowed)) {
                return redirect()->route('profile.edit')
                    ->with('force_password_change', true);
            }
        }

        return $next($request);
    }
}
