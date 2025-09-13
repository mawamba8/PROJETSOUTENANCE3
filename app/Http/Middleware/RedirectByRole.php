<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectByRole
{
    public function handle(\Illuminate\Http\Request $request, \Closure $next)
{
    if (!auth()->check()) {
        return $next($request);
    }

    // On redirige uniquement si on arrive à la racine
    if ($request->is('/')) {
        $u = auth()->user();
        if ($u->isAdmin())  return redirect()->route('admin.dashboard');
        if ($u->isDoctor()) return redirect()->route('doctor.dashboard');
        return redirect()->route('patient.dashboard');
    }

    return $next($request);
}

}
