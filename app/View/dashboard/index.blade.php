<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Carnet Médical Numérique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">🏥 Carnet Médical</a>
        </div>
    </nav>

    <div class="container py-5">
        <h1 class="text-center mb-4">📊 Tableau de Bord</h1>

        <!-- Statistiques rapides -->
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-success">🧑‍🤝‍🧑 Patients</h5>
                        <h3>{{ $patientsCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-primary">👨‍⚕ Médecins</h5>
                         <h3>{{ $medecinsCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-warning">📅 Rendez-vous</h5>
                        <h3>{{ $rendezVousCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="text-danger">🩺 Consultations</h5>
                        <h3>{{ $consultationsCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="text-center mb-3">📅 Rendez-vous par mois</h5>
                        <canvas id="rdvChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm">
<div class="card-body">
                        <h5 class="text-center mb-3">🩺 Consultations par mois</h5>
                        <canvas id="consultChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const months = @json($months);
        const rdvData = @json($rdvByMonth);
        const consultData = @json($consultByMonth);

        // Graphique Rendez-vous
        new Chart(document.getElementById('rdvChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Rendez-vous',
                    data: rdvData,
                    borderColor: 'orange',
                    backgroundColor: 'rgba(255,165,0,0.2)',
                    fill: true
                }]
            }
        });

        // Graphique Consultations
        new Chart(document.getElementById('consultChart'), {
            type: 'bar',
            data: {
                labels: months,
                 datasets: [{
                    label: 'Consultations',
                    data: consultData,
                    backgroundColor: 'rgba(220,53,69,0.6)',
                    borderColor: 'darkred',
                    borderWidth: 1
                }]
            }
        });
    </script>

</body>
</html>

