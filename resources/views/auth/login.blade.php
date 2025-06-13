<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Connexion - {{ config('app.name', 'PFE Management') }}</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/user.png') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styling -->
    <style>
        body {
            /* Un dégradé plus doux et moderne */
            background: #f4f7f6; /* Fallback */
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Important pour les coins arrondis de l'image */
        }

        .login-card-img {
            background-image: url('{{ asset('images_profil/back.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .form-control {
            border-radius: 0.5rem;
            padding: 0.85rem 1rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        
        .btn-primary {
            padding: 0.85rem;
            border-radius: 0.5rem;
            font-weight: 600;
            background-color: #0d6efd;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .login-title {
            font-weight: 700;
            color: #212529;
        }
        
        .form-check-label {
            cursor: pointer;
        }
        
        a.link-secondary {
            text-decoration: none;
            color: #6c757d;
            transition: color 0.3s ease;
        }
        a.link-secondary:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<main class="login-container">
    <div class="col-xl-10 col-lg-11">
        <div class="card login-card">
            <div class="row g-0">
                <!-- Colonne de l'image -->
                <div class="col-md-6 d-none d-md-block login-card-img">
                    <!-- L'image est gérée par le CSS pour un meilleur contrôle -->
                </div>

                <!-- Colonne du formulaire -->
                <div class="col-md-6 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5">
                        
                        <div class="text-center mb-4">
                            <h1 class="login-title h2">Bienvenue !</h1>
                            <p class="text-muted">Connectez-vous pour accéder à votre espace.</p>
                        </div>

                        <!-- Session Status (e.g., password reset success message) -->
                        <x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Institutionnel</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="nom.prenom@etu.uae.ac.ma">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="••••••••">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                                    <label class="form-check-label" for="remember_me">Se souvenir de moi</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-secondary small">Mot de passe oublié ?</a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </div>

                            <hr class="my-4">

                            <p class="text-center text-muted small">
                                Pas encore de compte ? 
                                <a href="{{ route('register') }}" class="fw-bold link-secondary">S'inscrire ici</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div> <!-- .row -->
        </div> <!-- .card -->
    </div> <!-- .col -->
</main> <!-- .login-container -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60M31lA7pskP0oC7pr+a5LzyjRAdOcxNqKcFtAXrD" crossorigin="anonymous"></script>

</body>
</html>