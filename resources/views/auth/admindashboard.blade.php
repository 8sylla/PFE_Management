<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - PFE Management</title>
    <link rel="icon" href="{{ asset('images/AdminRo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Select2 pour les listes déroulantes améliorées -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    
    <!-- Custom Modern Styles -->
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --primary-gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .content-wrapper { background: transparent; }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease-in-out;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.12); }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
        }
        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
        }
        .btn-primary { background: var(--primary-gradient); border: none; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 7px 14px rgba(102, 126, 234, 0.4); }
        .main-sidebar { background: #1e293b; }
        .brand-link { border-bottom-color: rgba(255,255,255,0.1); }
        [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
            background-color: rgba(255,255,255,0.1);
        }
        .nav-sidebar .nav-link.active { background-color: var(--primary-color); }
        .page-title { font-weight: 700; color: #1e293b; }
        .breadcrumb-item a { color: var(--primary-color); }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user-circle"></i> {{ Auth::guard('admin')->user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user-cog mr-2"></i> Mon Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
            <span class="brand-text font-weight-light">PFE Admin Panel</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i><p>Tableau de bord</p>
                        </a>
                    </li>
                    <li class="nav-header">GESTION PRINCIPALE</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.ens') }}" class="nav-link {{ request()->routeIs('admin.ens*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i><p>Encadrants</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('showsoutenance') }}" class="nav-link {{ request()->routeIs('showsoutenance*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-graduation-cap"></i><p>Soutenances</p>
                        </a>
                    </li>
                    <li class="nav-header">CONFIGURATION</li>
                    <li class="nav-item">
                        <a href="{{ route('jury') }}" class="nav-link {{ request()->routeIs('jury*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i><p>Jurys</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{-- Remplacer par la route des salles --}}" class="nav-link">
                            <i class="nav-icon fas fa-door-open"></i><p>Salles</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="page-title">@yield('page-title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                            @yield('breadcrumbs')
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                @endif
                 @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur !</strong> Veuillez corriger les problèmes ci-dessous.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </section>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script>
$(function () {
    // Initialiser Select2
    $('.select2').select2({
        theme: 'bootstrap4'
    });
});
</script>
@stack('scripts')
</body>
</html>