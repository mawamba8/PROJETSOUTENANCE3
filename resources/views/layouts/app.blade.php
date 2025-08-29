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
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, var(--primary) 0%, #1a5276 100%);
            color: white;
            height: 100vh;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
            padding-top: 20px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            margin: 0.2rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 25px;
        }
        
        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }
        
        /* Cards */
        .medical-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: none;
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        
        .medical-card:hover {
            transform: translateY(-2px);
        }
        
        .card-header-medical {
            background: linear-gradient(90deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            border: none;
        }
        
        /* Buttons */
        .btn-medical {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        
        .btn-medical:hover {
            background-color: #236685;
            border-color: #236685;
            color: white;
        }
        
        /* Badges */
        .badge-medical {
            background-color: var(--secondary);
            color: var(--dark);
        }
        
        /* Logo */
        .app-logo {
            text-align: center;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        
        .app-logo i {
            font-size: 2.5rem;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .app-logo h4 {
            color: white;
            margin-top: 1rem;
            font-weight: 300;
        }
        
        /* User dropdown */
        .user-dropdown .dropdown-toggle::after {
            display: none;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                text-align: center;
            }
            
            .sidebar .nav-link span {
                display: none;
            }
            
            .sidebar .nav-link i {
                margin-right: 0;
            }
            
            .main-content {
                margin-left: 80px;
            }
            
            .app-logo h4 {
                display: none;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="app-logo">
            <i class="fas fa-heartbeat"></i>
            <h4>Carnet Médical</h4>
        </div>
        
        <nav class="nav flex-column">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>📊 Tableau de bord</span>
            </a>

            <a class="nav-link {{ Request::is('medecins*') ? 'active' : '' }}" href="{{ route('medecins.index') }}">
                <i class="fas fa-pills"></i>
                <span>🧑‍⚕Medecin</span>
            </a>

            <a class="nav-link {{ Request::is('patients*') ? 'active' : '' }}" href="{{ route('patients.index') }}">
                <i class="fas fa-user-injured"></i>
                <span>🧑‍🤝‍🧑Patients</span>
            </a>
            
            <a class="nav-link {{ Request::is('rendezvous*') ? 'active' : '' }}" href="{{ route('rendezvous.index') }}">
                <i class="fas fa-calendar-check"></i>
                <span>📅 Rendez-vous</span>
            </a>
            
            <a class="nav-link {{ Request::is('consultations*') ? 'active' : '' }}" href="{{ route('consultations.index') }}">
                <i class="fas fa-stethoscope"></i>
                <span>📝Consultation</span>
            </a>
            
            <a class="nav-link {{ Request::is('traitements*') ? 'active' : '' }}" href="{{ route('traitements.index') }}">
                <i class="fas fa-pills"></i>
                <span>🩺 Traitement</span>
            </a>
            
            <a class="nav-link {{ Request::is('carnets*') ? 'active' : '' }}" href="{{ route('carnets.index') }}">
                <i class="fas fa-folder-medical"></i>
                <span>📔carnets</span>
            </a>
            
            <div class="mt-4">
                <a class="nav-link {{ Request::is('profil*') ? 'active' : '' }}" href="{{ route('profil.edit') }}">
                    <i class="fas fa-user-cog"></i>
                    <span>👤Profil</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="nav-link" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span> 🔓Déconnexion</span>
                    </a>
                </form>
            </div>
        </nav>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="btn btn-sm d-md-none" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="d-flex align-items-center ms-auto">
                    <div class="dropdown user-dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
                           id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                 style="width: 40px; height: 40px;">
                                <i class="fas fa-user-md text-white"></i>
                            </div>
                            <span class="ms-2 d-none d-lg-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profil.edit') }}">
                                <i class="fas fa-user-cog me-2"></i>Profil
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page content -->
        <main>
            @if (isset($header))
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0" style="color: var(--primary);">
                        <i class="fas fa-@yield('icon', 'home') me-2"></i>
                        {{ $header }}
                    </h2>
                    @yield('actions')
                </div>
            @endif

            <!-- Messages flash -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Content -->
             @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script pour le menu responsive
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('[data-bs-toggle="sidebar"]');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    document.querySelector('.sidebar').classList.toggle('collapsed');
                    document.querySelector('.main-content').classList.toggle('collapsed');
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>