<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Gérer l'accès selon le rôle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Récupère le rôle de l'utilisateur
        $userRole = Auth::user()->role->name ?? null;

        // Vérifie si l'utilisateur a le rôle requis
        if ($userRole !== $role) {
            // Tu peux faire soit abort(403), soit redirect vers une page safe
            abort(403, 'Accès interdit');
        }

        return $next($request);
    }
}