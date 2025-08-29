<?php

namespace App\Http\Controllers;

use App\Models\CarnetMedical;
use App\Models\Patient;
use Illuminate\Http\Request;

class Carnet_MedicalController extends Controller
{
    public function index()
    {
        $carnets = CarnetMedical::with('patient')->get();
        return view('carnets.index', compact('carnets'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('carnets.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'historique' => 'nullable|string',
            'allergies' => 'nullable|string',
            'antecedents' => 'nullable|string',
        ]);

        CarnetMedical::create($request->all());
   return redirect()->route('carnets.index')->with('success', 'Carnet médical créé avec succès');
    }

    public function show(CarnetMedical $carnet)
    {
        return view('carnets.show', compact('carnet'));
    }

    public function edit(CarnetMedical $carnet)
    {
        $patients = Patient::all();
        return view('carnets.edit', compact('carnet','patients'));
    }

    public function update(Request $request, CarnetMedical $carnet)
    {
        $request->validate([
            'historique' => 'nullable|string',
            'allergies' => 'nullable|string',
            'antecedents' => 'nullable|string',
        ]);
 $carnet->update($request->all());

        return redirect()->route('carnets.index')->with('success', 'Carnet médical mis à jour avec succès');
    }

    public function destroy(CarnetMedical $carnet)
    {
        $carnet->delete();
        return redirect()->route('carnets.index')->with('success', 'Carnet médical supprimé avec succès');
    }
}



