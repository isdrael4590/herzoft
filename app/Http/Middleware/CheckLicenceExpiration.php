<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Setting\Entities\Licence;
use Illuminate\Support\Facades\Auth;

class CheckLicenceExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Rutas excluidas de la verificación
        $excludedRoutes = [
            'login',
            'logout',
            'password.request',
            'password.email',
            'password.reset',
        ];

        // Si la ruta está excluida, permitir acceso
        $currentRoute = $request->route() ? $request->route()->getName() : null;
        
        if (in_array($currentRoute, $excludedRoutes)) {
            return $next($request);
        }

        // Si el usuario NO está autenticado, permitir continuar
        // (el middleware 'auth' se encargará de redirigir al login)
        if (!Auth::check()) {
            return $next($request);
        }

        // Usuario autenticado - verificar licencia
        $licence = Licence::first();
        
        $isExpired = !$licence || 
                     !$licence->license_expiration_date || 
                     $licence->license_expiration_date->isPast();
        
        if ($isExpired) {
            $user = Auth::user();
            
            // Verificar si el usuario es Admin o Super Admin
            $allowedRoles = ['Admin', 'Super Admin'];
            $hasAccess = false;
            
            foreach ($allowedRoles as $role) {
                if ($user->hasRole($role)) {
                    $hasAccess = true;
                    break;
                }
            }

            if ($hasAccess) {
                // Admins: permitir acceso con advertencia
                if (!session()->has('licence_expired_warning')) {
                    session()->flash('licence_expired_warning', true);
                    session()->flash('days_expired', abs(now()->diffInDays($licence->license_expiration_date, false)));
                }
                return $next($request);
            }
            
            // Usuarios sin privilegios: BLOQUEAR
            if ($request->ajax()) {
                return response()->json([
                    'expired' => true,
                    'message' => 'La licencia del sistema ha expirado. Acceso denegado.'
                ], 403);
            }
            
            // Mostrar página de licencia expirada
            return response()->view('errors.licence-expired', [
                'user' => $user,
                'licence' => $licence
            ], 403);
        }
        
        return $next($request);
    }
}