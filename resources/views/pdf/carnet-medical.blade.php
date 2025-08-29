<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Carnet Médical - {{ $patient->code_patient }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #2c5282;
            margin: 0;
        }
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #2c5282;
            color: white;
            padding: 5px 10px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .patient-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .info-item {
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            color: #2c5282;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            padding: 8px;
            text-align: left;
        }
        td {
            padding: 8px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
        .consultation-item, .rdv-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 5px;
        }
        .urgent {
            color: #e53e3e;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CARNET MÉDICAL</h1>
        <p>Code Patient: <strong>{{ $patient->code_patient }}</strong></p>
        <p>Généré le: {{ $dateGeneration }}</p>
    </div>

    <!-- Informations du patient -->
    <div class="section">
        <div class="section-title">INFORMATIONS PERSONNELLES</div>
        <div class="patient-info">
            <div class="info-item">
                <span class="info-label">Nom complet:</span> {{ $patient->name }}
            </div>
            <div class="info-item">
                <span class="info-label">Email:</span> {{ $patient->email }}
            </div>
            <div class="info-item">
                <span class="info-label">Téléphone:</span> {{ $patient->telephone }}
            </div>
            <div class="info-item">
                <span class="info-label">Date de naissance:</span> {{ $patient->date_naissance->format('d/m/Y') }}
            </div>
            <div class="info-item">
                <span class="info-label">Âge:</span> {{ now()->diffInYears($patient->date_naissance) }} ans
            </div>
            <div class="info-item">
                <span class="info-label">Adresse:</span> {{ $patient->adresse }}
            </div>
        </div>
         </div>

    <!-- Médecin traitant -->
    @if($medecinTraitant)
    <div class="section">
        <div class="section-title">MÉDECIN TRAITANT</div>
        <div class="patient-info">
            <div class="info-item">
                <span class="info-label">Nom:</span> {{ $medecinTraitant->name }}
            </div>
            <div class="info-item">
                <span class="info-label">Spécialité:</span> {{ $medecinTraitant->specialite }}
            </div>
            <div class="info-item">
                <span class="info-label">Contact:</span> {{ $medecinTraitant->telephone }}
            </div>
        </div>
    </div>
    @endif
 <!-- Historique des consultations -->
    <div class="section">
        <div class="section-title">HISTORIQUE DES CONSULTATIONS ({{ $consultations->count() }})</div>
        
        @if($consultations->count() > 0)
            @foreach($consultations as $consultation)
            <div class="consultation-item">
                <div><strong>Date:</strong> {{ $consultation->date_consultation->format('d/m/Y H:i') }}</div>
                <div><strong>Médecin:</strong> Dr. {{ $consultation->medecin->name }}</div>
                <div><strong>Spécialité:</strong> {{ $consultation->medecin->specialite }}</div>
                <div><strong>Diagnostic:</strong> {{ $consultation->diagnostic }}</div>
                <div><strong>Prescription:</strong> {{ $consultation->prescription }}</div>
                @if($consultation->observations)
                <div><strong>Observations:</strong> {{ $consultation->observations }}</div>
                @endif
            </div>
            @if(!$loop->last)<hr>@endif
            @endforeach
        @else
            <p>Aucune consultation enregistrée.</p>
        @endif
    </div>

    <!-- Rendez-vous -->
    <div class="section">
        <div class="section-title">RENDEZ-VOUS ({{ $rendezvous->count() }})</div>
        
        @if($rendezvous->count() > 0)
            @foreach($rendezvous as $rdv)
            <div class="rdv-item">
                <div><strong>Date:</strong> {{ $rdv->date_rdv->format('d/m/Y H:i') }}</div>
                <div><strong>Médecin:</strong> Dr. {{ $rdv->medecin->name }}</div>
                <div><strong>Statut:</strong> 
                    <span class="{{ $rdv->statut == 'urgent' ? 'urgent' : '' }}">
                        {{ ucfirst($rdv->statut) }}
                    </span>
                </div>
                <div><strong>Motif:</strong> {{ $rdv->motif }}</div>
                @if($rdv->notes)
                <div><strong>Notes:</strong> {{ $rdv->notes }}</div>
                @endif
            </div>
            @if(!$loop->last)<hr>@endif
            @endforeach
        @else
            <p>Aucun rendez-vous enregistré.</p>
        @endif
    </div>

    <!-- Informations médicales importantes -->
    <div class="section">
        <div class="section-title">INFORMATIONS MÉDICALES IMPORTANTES</div>
        <p>En cas d'urgence, présentez ce carnet médical aux services de secours.</p>
        <p>Ce document contient l'historique médical complet du patient.</p>
    </div>

    <div class="footer">
        <p>Document généré automatiquement par le Système de Gestion Médicale</p>
        <p>Code patient: {{ $patient->code_patient }} | Confidentialité médicale assurée</p>
    </div>

    @if(isset($preview) && $preview)
    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('patient.download.carnet') }}" class="btn btn-primary">
            Télécharger le PDF
        </a>
    </div>
    @endif
</body>
</html>


