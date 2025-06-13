<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teacher Dashboard</title>
  <link rel="icon" href="../images/Teacher.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/Fiche_PFE.css') }}"/>
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- AdminLTE -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
      --secondary-gradient: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
      --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
      --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      --glass-bg: rgba(255, 255, 255, 0.25);
      --glass-border: rgba(255, 255, 255, 0.18);
      --shadow-light: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      --shadow-dark: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    * {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
      min-height: 100vh;
      position: relative;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: 
        radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(16, 185, 129, 0.3) 0%, transparent 50%);
      pointer-events: none;
      z-index: -1;
    }

    /* Header moderne avec effet glassmorphism */
    .main-header {
      background: var(--glass-bg) !important;
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      box-shadow: var(--shadow-light);
      padding: 1rem 2rem;
      z-index: 1000;
    }

    .navbar-nav .nav-link {
      color: white !important;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 10px;
      margin: 0 0.25rem;
      position: relative;
      overflow: hidden;
    }

    .navbar-nav .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }

    .navbar-nav .nav-link:hover::before {
      left: 100%;
    }

    .navbar-nav .nav-link:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
    }

    /* Sidebar moderne */
    .main-sidebar {
      background: var(--glass-bg) !important;
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      box-shadow: var(--shadow-light);
      border-radius: 0 20px 20px 0;
      margin: 10px 0;
      height: calc(100vh - 20px);
    }

    .brand-link {
      font-weight: 700;
      font-size: 1.5rem;
      color: #ffffff !important;
      text-align: center;
      padding: 1.5rem;
      background: var(--primary-gradient);
      margin: 1rem;
      border-radius: 15px;
      box-shadow: var(--shadow-dark);
      position: relative;
      overflow: hidden;
    }

    .brand-link::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
      transform: rotate(45deg);
      transition: all 0.5s;
      opacity: 0;
    }

    .brand-link:hover::before {
      animation: shine 0.7s ease-in-out;
    }

    @keyframes shine {
      0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); opacity: 0; }
      50% { opacity: 1; }
      100% { transform: translateX(100%) translateY(100%) rotate(45deg); opacity: 0; }
    }

    .user-panel {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 15px;
      margin: 1rem;
      padding: 1rem;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .user-panel .image img {
      border: 3px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .user-panel .info a {
      color: #ffffff !important;
      font-weight: 600;
      font-size: 1.1rem;
    }

    /* Navigation sidebar */
    .nav-sidebar .nav-link {
      color: rgba(255, 255, 255, 0.8) !important;
      font-weight: 500;
      margin: 0.25rem 1rem;
      border-radius: 12px;
      padding: 0.75rem 1rem;
      position: relative;
      transition: all 0.3s ease;
    }

    .nav-sidebar .nav-link:hover {
      background: rgba(255, 255, 255, 0.15) !important;
      color: #ffffff !important;
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .nav-sidebar .nav-link.active {
      background: var(--primary-gradient) !important;
      color: #ffffff !important;
      box-shadow: 0 5px 20px rgba(59, 130, 246, 0.4);
    }

    .nav-sidebar .nav-icon {
      margin-right: 0.75rem;
      width: 20px;
      text-align: center;
    }

    /* Content wrapper moderne */
    .content-wrapper {
      background: transparent;
      margin: 20px 20px 20px 280px;
      border-radius: 20px;
      padding: 0;
      min-height: calc(100vh - 40px);
    }

    .content {
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 20px;
      padding: 2rem;
      margin: 0;
      box-shadow: var(--shadow-light);
      min-height: calc(100vh - 120px);
    }

    .content h1, .content h2, .content h3 {
      font-weight: 700;
      color: #ffffff;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      margin-bottom: 1.5rem;
    }

    .content h1 {
      font-size: 2.5rem;
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Boutons modernes */
    .btn {
      border-radius: 12px;
      font-weight: 600;
      padding: 0.75rem 1.5rem;
      border: none;
      position: relative;
      overflow: hidden;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s ease;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn-info {
      background: var(--primary-gradient);
      box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
    }

    .btn-info:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(59, 130, 246, 0.6);
    }

    .btn-success {
      background: var(--success-gradient);
      box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
    }

    .btn-warning {
      background: var(--warning-gradient);
      box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
    }

    .btn-secondary {
      background: var(--secondary-gradient);
      box-shadow: 0 5px 15px rgba(6, 182, 212, 0.4);
    }

    /* Cards modernes */
    .card {
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 20px;
      box-shadow: var(--shadow-light);
      margin-bottom: 2rem;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background: rgba(255, 255, 255, 0.1);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      padding: 1.5rem;
    }

    .card-body {
      padding: 2rem;
      color: rgba(255, 255, 255, 0.9);
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .content > * {
      animation: fadeInUp 0.6s ease forwards;
    }

    .content > *:nth-child(2) { animation-delay: 0.1s; }
    .content > *:nth-child(3) { animation-delay: 0.2s; }
    .content > *:nth-child(4) { animation-delay: 0.3s; }

    /* Responsive */
    @media (max-width: 768px) {
      .content-wrapper {
        margin: 10px;
      }
      
      .main-sidebar {
        transform: translateX(-100%);
      }
      
      .sidebar-open .main-sidebar {
        transform: translateX(0);
      }
    }

    /* Scrollbar personnalisée */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
      background: var(--primary-gradient);
      border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--secondary-gradient);
    }

    /* Contrôles sidebar */
    .control-sidebar {
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 20px 0 0 20px;
    }

    /* Styles spécifiques aux enseignants */
    .teacher-stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin: 2rem 0;
    }

    .stat-card {
      background: var(--glass-bg);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 15px;
      padding: 2rem;
      text-align: center;
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .stat-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      background: var(--primary-gradient);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 0.5rem;
    }

    .stat-label {
      color: rgba(255, 255, 255, 0.8);
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('teacher.dashboard') }}" class="nav-link">
          <i class="fas fa-home mr-2"></i>Accueil
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">
          <i class="fas fa-envelope mr-2"></i>Contact
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST">@csrf</form>
        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
        </a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-cog"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar elevation-4">
    <a href="{{ route('teacher.dashboard') }}" class="brand-link">
      <i class="fas fa-chalkboard-teacher mr-2"></i>
      <span class="brand-text">Teacher</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="{{ route('teacher.dashboard') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Tableau de bord</p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Gestion
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('teacher.studenttable') }}" class="nav-link">
                  <i class="fas fa-user-graduate nav-icon"></i>
                  <p>Étudiants</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('teacher.soutenance') }}" class="nav-link">
                  <i class="fas fa-graduation-cap nav-icon"></i>
                  <p>Soutenances</p>
                </a>
              </li>
            </ul>
          </li>

         

          
         
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        <!-- Contenu du dashboard teacher -->
        <h1><i class="fas fa-chalkboard-teacher mr-3"></i>Espace Enseignant</h1>
        
        <div class="teacher-stats">
          <div class="stat-card">
            <div class="stat-icon">
              <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-number">6</div>
            <div class="stat-label">Étudiants Encadrés</div>
          </div>
          
          <div class="stat-card">
            <div class="stat-icon">
              <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-number">12</div>
            <div class="stat-label">Soutenances à Venir</div>
          </div>
          
          <div class="stat-card">
            <div class="stat-icon">
              <i class="fas fa-tasks"></i>
            </div>
            <div class="stat-number">8</div>
            <div class="stat-label">Projets en Cours</div>
          </div>
          
          <div class="stat-card">
            <div class="stat-icon">
              <i class="fas fa-trophy"></i>
            </div>
            <div class="stat-number">15</div>
            <div class="stat-label">Projets Terminés</div>
          </div>
        </div>

          
          <div class="col-md-6">
         
          </div>
        </div>

        @yield('content')
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<!-- Scripts -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
<script src="../../dist/js/demo.js"></script>

<script>
// Animation pour les cartes de statistiques
$(document).ready(function() {
    $('.stat-card').each(function(index) {
        $(this).delay(index * 150).animate({
            opacity: 1,
            transform: 'translateY(0)'
        }, 600);
    });
    
    // Animation des nombres
    $('.stat-number').each(function() {
        var $this = $(this);
        var countTo = $this.text();
        
        $({ countNum: 0 }).animate({
            countNum: countTo
        }, {
            duration: 2000,
            easing: 'swing',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });
    });
});

// Effet de rotation pour les icônes au survol
$('.nav-sidebar .nav-link').hover(
    function() {
        $(this).find('.nav-icon').addClass('fa-spin');
    },
    function() {
        $(this).find('.nav-icon').removeClass('fa-spin');
    }
);

// Effet de pulsation pour les icônes de statistiques
$('.stat-icon i').hover(
    function() {
        $(this).addClass('fa-bounce');
    },
    function() {
        $(this).removeClass('fa-bounce');
    }
);
</script>
</body>
</html>