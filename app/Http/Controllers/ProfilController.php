<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class ProfilController extends Controller
{
    // Afficher la page du profil
    public function index()
    {
        return view('profile.index');
        // crée resources/views/profil/index.blade.php
    }
 public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profil.edit', compact('user'));
    }
    // Mettre à jour le profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        // Exemple si tu utilises Auth
        // $user = auth()->user();
        // $user->update($request->all());

        return redirect()->route('profile.index')->with('success', 'Profile mis à jour avec succès.');
}
}
