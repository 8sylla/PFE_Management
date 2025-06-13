<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/Fiche_PFE.css') }}"/>
        <link rel="icon" href="images/Student.png"/>
        <title>Student</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                font-family: 'Figtree', sans-serif;
            }
            
            .bg-gray-100 {
                background: rgba(255, 255, 255, 0.95) !important;
                backdrop-filter: blur(10px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }
            
            /* MODIFIED .welcome-container STYLES START HERE */
            .welcome-container {
                text-align: center; 
                background: #ffffff; /* Changed from gradient to solid white */
                border-radius: 16px; /* Slightly adjusted border-radius */
                padding: 30px; 
                font-family: 'Figtree', sans-serif; 
                color: #333;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08); /* Softened box shadow */
                border: 1px solid #e2e8f0; /* Changed to a subtle gray border */
                margin: 20px auto;
                max-width: 800px;
                position: relative;
                overflow: hidden; /* Kept for potential future effects if added back */
            }
            
            /* Removed .welcome-container::before (animated top border) */
            
            @keyframes gradient-shift { /* This animation is no longer used by .welcome-container but kept if other elements use it */
                0%, 100% { transform: translateX(-100%); }
                50% { transform: translateX(100%); }
            }
            
            .welcome-container h1 {
                margin-bottom: 15px;
                font-size: 38px; /* Slightly adjusted font size */
                font-weight: 600;
                color: #1f2937; /* Changed from gradient text to solid color */
                /* Removed -webkit-background-clip, -webkit-text-fill-color, background-clip, text-shadow */
                animation: fadeInUp 1s ease-out;
                position: relative; /* Kept for centering, emojis removed */
            }
            
            /* Removed .welcome-container h1::before and h1::after (animated emojis) */
            
            .welcome-container h2 {
                margin-top: 0; 
                font-weight: 400;
                font-size: 20px; /* Slightly adjusted font size */
                color: #4b5563; /* Slightly adjusted color */
                animation: fadeInUp 1s ease-out 0.2s both;
            }
            /* MODIFIED .welcome-container STYLES END HERE */
            
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
            
            /* NOUVEAUX STYLES POUR AMÉLIORER VOS CARDS EXISTANTES */
            .card {
                background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%) !important;
                border-radius: 20px !important;
                padding: 35px 30px !important;
                box-shadow: 
                    0 20px 40px rgba(0, 0, 0, 0.1),
                    0 8px 25px rgba(0, 0, 0, 0.08) !important;
                border: 1px solid rgba(255, 255, 255, 0.8) !important;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
                position: relative;
                overflow: hidden;
                margin-bottom: 0 !important; /* Supprime la marge pour éviter le décalage */
                display: flex;
                flex-direction: column;
            }
            
            .card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
                background-size: 300% 100%;
                animation: gradient-flow 3s ease infinite;
            }
            
            .card:hover {
                transform: translateY(-8px) scale(1.02) !important;
                box-shadow: 
                    0 30px 60px rgba(0, 0, 0, 0.15),
                    0 15px 40px rgba(0, 0, 0, 0.12) !important;
            }
            
            .card:hover::before {
                animation-duration: 1s;
            }
            
            .card-body {
                text-align: center !important;
                position: relative;
                z-index: 1;
                flex: 1; /* Prend tout l'espace disponible */
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            
            .card-title {
                font-size: 24px !important;
                font-weight: 600 !important;
                color: #1f2937 !important;
                margin-bottom: 15px !important;
                transition: color 0.3s ease !important;
            }
            
            .card:hover .card-title {
                color: #667eea !important;
            }
            
            .card-text {
                font-size: 16px !important;
                color: #6b7280 !important;
                line-height: 1.6 !important;
                margin-bottom: 25px !important;
            }
            
            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                border: none !important;
                border-radius: 12px !important;
                padding: 12px 30px !important;
                font-weight: 600 !important;
                text-transform: uppercase !important;
                letter-spacing: 0.5px !important;
                transition: all 0.3s ease !important;
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3) !important;
            }
            
            .btn-primary:hover {
                transform: translateY(-2px) !important;
                box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4) !important;
                background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
            }
            
            /* Style pour les icônes si vous en avez */
            .card-icon {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 25px;
                font-size: 32px;
                color: white;
                box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
                transition: all 0.3s ease;
            }
            
            .card:hover .card-icon {
                transform: rotate(5deg) scale(1.1);
                box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
            }
            
            @keyframes gradient-flow {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            
            /* Animation d'apparition des cards */
            .card {
                animation: slideInUp 0.6s ease-out forwards;
                opacity: 0;
                transform: translateY(30px);
                height: fit-content; /* Hauteur adaptée au contenu */
            }
            
            .card:nth-child(1) { animation-delay: 0.1s; }
            .card:nth-child(2) { animation-delay: 0.1s; } /* Même délai pour synchroniser */
            .card:nth-child(3) { animation-delay: 0.1s; }
            
            @keyframes slideInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Container pour organiser les cards */
            .cards-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
                padding: 20px 0;
                align-items: start; /* Aligne les cards en haut */
            }
            
            .alert {
                border-radius: 15px;
                border: none;
                padding: 20px 25px;
                margin: 20px auto;
                max-width: 600px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
                font-weight: 500;
                position: relative;
                overflow: hidden;
            }
            
            .alert-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
                animation: slideInRight 0.5s ease-out;
                padding-left: 50px; /* Ensured padding is defined once */
            }
            
            .alert-success::before {
                content: '✓';
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                font-size: 18px;
                font-weight: bold;
            }
            
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(100px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            main {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                margin: 20px auto;
                padding: 30px;
                max-width: 1200px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                min-height: 400px;
            }
            
            header {
                border-radius: 0 0 20px 20px;
            }
            
            /* Removed @keyframes bounce as emojis are removed, but kept if other elements use it */
            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateY(0);
                }
                40% {
                    transform: translateY(-10px);
                }
                60% {
                    transform: translateY(-5px);
                }
            }
            
            /* Responsive design */
            @media (max-width: 768px) {
                .welcome-container {
                    margin: 10px;
                    padding: 20px;
                }
                
                .welcome-container h1 {
                    font-size: 28px; /* Adjusted for new base size */
                }
                
                /* .welcome-container h1::before, .welcome-container h1::after are already removed so no need for display:none here */
                
                main {
                    margin: 10px;
                    padding: 20px;
                }
                
                .cards-container {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
                
                .card {
                    padding: 25px 20px !important;
                }
                
                .card-icon {
                    width: 60px;
                    height: 60px;
                    font-size: 28px;
                }
                
                .card-title {
                    font-size: 20px !important;
                }
            }
            
            body::before { /* This is for the main page background blur effect if needed - currently body has direct gradient */
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Ensure this matches body if it's meant to be a fallback or overlay */
                z-index: -1; 
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-100">
            @include('layouts.navigation')

            @if (isset($header))
                <header>
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
        </div><br>
        
        <div class="welcome-container">
            <h1 style="margin-bottom: 15px;font-size:38px">Welcome to Your Student Dashboard</h1>
            <h2 style="margin-top: 0; font-weight: normal;font-size:20px; color: #4b5563;">Your Gateway to Learning and Success!</h2>
        </div>       
        
        <main style="">
            @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
            @endif
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $("#success-alert").slideDown(500).delay(1800).slideUp(500, function() {
                        $(this).remove();
                    });
                });
            </script>
            @yield('content')
        </main><br>
            
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>