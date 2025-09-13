<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function show(User $patient){
        $auth = Auth::user();
        // autorisation simple (admin, le patient lui-même, ou médecin)
        if(!($auth->isAdmin() || $auth->id===$patient->id || $auth->isDoctor())){
            abort(403);
        }
        $records = MedicalRecord::where('patient_id',$patient->id)->with('doctor')->latest()->get();
        return view('records.show', compact('patient','records'));
    }

    public function store(Request $r, User $patient){
        $auth = Auth::user();
        if(!$auth->isDoctor() && !$auth->isAdmin()){ abort(403); }
        $data = $r->validate([
            'summary'=>'nullable|string',
            'diagnosis'=>'nullable|string',
            'treatment'=>'nullable|string',
        ]);
        $data['patient_id'] = $patient->id;
        $data['doctor_id']  = $auth->id;
        MedicalRecord::create($data);
        return back()->with('ok','Note médicale ajoutée.');
    }

    public function lock(MedicalRecord $record){
        $auth = Auth::user();
        if(!$auth->isDoctor() && !$auth->isAdmin()){ abort(403); }
        if(!$record->locked_at){
            $record->locked_at = now();
            $record->save();
        }
        return back()->with('ok','Dossier verrouillé.');
    }
}
