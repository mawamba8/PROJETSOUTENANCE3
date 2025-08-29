<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
   /* public function index()
    {
        // Page d’accueil publique
        return view('home');

    }*/

     <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Si l'utilisateur est connecté, rediriger vers le dashboard approprié
        if (auth()->check()) {
            $user = auth()->user();
            
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->isMedecin()) {
                return redirect()->route('medecin.dashboard');
            } elseif ($user->isPatient()) {
                return redirect()->route('patient.dashboard');
                }
        }

        // Sinon, afficher la page d'accueil normale
        return view('home');
    }

       
}




