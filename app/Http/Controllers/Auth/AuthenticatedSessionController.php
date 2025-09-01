<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la page de connexion.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Traite la connexion.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

    if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            //return redirect()->intended('dashboard'); // ou redirige vers la bonne page selon le rôle
        //}

        $user = Auth::user();



        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isMedecin()) {
            return redirect()->route('medecin.dashboard');
        } elseif ($user->isPatient()) {
            return redirect()->route('patient.dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);

        return back()->withErrors([
            'email' => 'Les identifiants ne correspondent pas.',
        ]);
    }
}

    /**
     * Déconnexion.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
    

