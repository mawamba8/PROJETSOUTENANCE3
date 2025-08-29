<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Carnet Médical Numérique')</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome@6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2c7da0;
            --secondary: #a5d8dd;
            --accent: #61a5c2;
            --light: #f8f9fa;
            --dark: #2c3e50;
        }
        
        body {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .auth-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .auth-header {
            background: var(--primary);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .auth-logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .auth-logo i {
            font-size: 2.5rem;
            color: var(--primary);
        }
        
        .auth-body {
            padding: 2rem;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: #236685;
            border-color: #236685;
        }
        
        .auth-footer {
            background: var(--light);
            padding: 1rem 2rem;
            text-align: center;
            border-top: 1px solid #eee;
        }
        
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(44, 125, 160, 0.25);
        }
        
        .medical-features {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1.5rem;
            margin-top: 2rem;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .feature-icon {
            width: 40px;
            height: 40px;
            background: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-container">
                    <div class="auth-header">
                        <div class="auth-logo">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h2>Carnet Médical Numérique</h2>
                        <p class="mb-0">Gestion de rendez-vous et suivi des consultations</p>
                    </div>

                    <div class="auth-body">
                        {{ $slot }}
                    </div>

                    <div class="auth-footer">
                        <p class="mb-0">
                            &copy; {{ date('Y') }} Carnet Médical Numérique. 
                            <a href="#" class="text-decoration-none">Politique de confidentialité</a>
                        </p>
                    </div>
                </div>

                <div class="medical-features">
                    <h5 class="text-center mb-4" style="color: var(--primary);">
                        <i class="fas fa-star-of-life me-2"></i>Fonctionnalités principales
                    </h5>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Gestion de rendez-vous</h6>
                            <small>Planification et suivi des consultations médicales</small>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Dossiers patients</h6>
                            <small>Stockage sécurisé des informations médicales</small>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-prescription"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Suivi des traitements</h6>
                            <small>Historique des prescriptions et suivis médicaux</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>