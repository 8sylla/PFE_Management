<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tableau de Bord') - Espace Encadrant</title>
    <link rel="icon" href="{{ asset('images/Teacher.png') }}">

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --ensat-blue: #003366;
            --ensat-light-blue: #005A9C;
            --ensat-accent: #f39c12; /* Un orange/jaune pour contraster */
            --light-gray: #f4f6f9;
        }
        body { font-family: 'Poppins', sans-serif; }
        .content-wrapper { background-color: var(--light-gray); }
        .main-sidebar { background-color: var(--ensat-blue); }
        .brand-link { border-bottom-color: rgba(255,255,255,0.1); }
        .brand-link .brand-text { font-weight: 600; }
        .main-header.navbar { border-bottom-color: #dee2e6; }
        [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link.active, 
        [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link {
            background-color: var(--ensat-light-blue);
            color: #ffffff;
        }
        .page-title { font-weight: 700; color: #343a40; }
        .breadcrumb-item a { color: var(--ensat-light-blue); }
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }
        .btn-primary { background-color: var(--ensat-light-blue); border-color: var(--ensat-light-blue); }
        .btn-primary:hover { background-color: var(--ensat-blue); border-color: var(--ensat-blue); }
        .small-box { border-radius: 0.5rem; }
        .small-box .icon>i { font-size: 70px; top: 15px; }
    </style>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user-circle mr-1"></i> {{ Auth::user()->name }} <i class="fas fa-caret-down ml-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('teacher.profile.edit') }}" class="dropdown-item"><i class="fas fa-user-cog mr-2"></i> Mon Profil</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('teacher.dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-bold mx-auto">ENSAT - Encadrant</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i><p>Tableau de bord</p>
                        </a>
                    </li>
                    <li class="nav-header">GESTION PÉDAGOGIQUE</li>
                    <li class="nav-item">
                        <a href="{{ route('teacher.students.index') }}" class="nav-link {{ request()->routeIs('teacher.students.*') || request()->routeIs('teacher.fiches.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-graduate"></i><p>Mes Étudiants & Fiches</p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('teacher.soutenances.index') }}" class="nav-link {{ request()->routeIs('teacher.soutenances.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i><p>Mes Soutenances</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark page-title">@yield('page-title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Accueil</a></li>
                            @yield('breadcrumbs')
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                 @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
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
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
@stack('scripts')
</body>
</html>