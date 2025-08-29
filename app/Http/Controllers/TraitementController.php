<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TraitementController extends Controller
{

    // Afficher la liste des traitements
    public function index()
    {
        return view('traitements.index'); 
        // tu dois créer le fichier resources/views/traitements/index.blade.php
    }

    // Enregistrer un traitement
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|integer',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date',
        ]);

        // Exemple si tu as un modèle Traitement
        // Traitement::create($request->all());

        return redirect()->route('traitements.index')->with('success', 'Traitement ajouté avec succès.');
    }
}