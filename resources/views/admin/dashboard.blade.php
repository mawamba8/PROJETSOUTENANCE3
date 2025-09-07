@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tableau de bord Administrateur</div>

                <div class="card-body">
                    <h4>Statistiques</h4>
                    <p>Médecins: {{ $medecins }}</p>
                    <p>Patients: {{ $patients }}</p>

                    <div class="mt-4">
                        <a href="{{ route('admin.create.medecin') }}" class="btn btn-primary">
                            Créer un compte Médecin
                        </a>
                        <a href="{{ route('admin.create.patient') }}" class="btn btn-success">
                            Créer un compte Patient
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
