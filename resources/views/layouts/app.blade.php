<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tableau de Bord') - Espace Étudiant ENSAT</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Student.png') }}">
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Pour les icônes Font Awesome -->

    <!-- Scripts (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f4f7f9; /* Un gris très clair, plus professionnel */
        }
        .ensat-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }
        .ensat-nav-link {
            color: #4b5563;
            border-bottom: 2px solid transparent;
        }
        .ensat-nav-link:hover {
            color: #003366; /* Bleu foncé ENSAT */
            border-bottom-color: #005A9C; /* Bleu moyen ENSAT */
        }
        .ensat-nav-link[aria-current="page"] {
            color: #003366;
            border-bottom-color: #003366;
            font-weight: 600;
        }
        .main-content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }
        .page-header {
            color: #1f2937;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.partials.student_navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="main-content">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.06 0l4-5.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>