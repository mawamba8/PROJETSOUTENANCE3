<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function redirectTo()
{
    $role = auth()->user()->role->name; // récupère le rôle de l’utilisateur connecté

    switch ($role) {
        case 'admin':
            return '/admin/dashboard'; // route de l’admin
        case 'medecin':
            return '/medecin/dashboard'; // route du médecin
        case 'patient':
            return '/patient/dashboard'; // route du patient
        default:
            return '/home'; // page par défaut si aucun rôle
    }
}
}
