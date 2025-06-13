<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login - Moderne</title>
    <link rel="icon" href="../images/Teacher.png"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Particules d'arrière-plan animées */
        .bg-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 100px;
            height: 100px;
            left: 15%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 150px;
            height: 150px;
            left: 30%;
            animation-delay: 3s;
        }

        .particle:nth-child(3) {
            width: 70px;
            height: 70px;
            left: 65%;
            animation-delay: 5s;
        }

        .particle:nth-child(4) {
            width: 120px;
            height: 120px;
            left: 85%;
            animation-delay: 2s;
        }

        .particle:nth-child(5) {
            width: 90px;
            height: 90px;
            left: 50%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-120px) rotate(180deg);
                opacity: 0.6;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            width: min(90vw, 1000px);
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .left-panel {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .logo-container {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }
        }

        .logo i {
            font-size: 2rem;
            color: white;
        }

        .welcome-text {
            position: relative;
            z-index: 2;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .welcome-text p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .right-panel {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .form-header p {
            color: #718096;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #4a5568;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-container {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-input:focus {
            outline: none;
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            transition: color 0.3s ease;
        }

        .form-input:focus ~ .input-icon {
            color: #4facfe;
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
        }

        .forgot-password a {
            color: #4facfe;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #00f2fe;
            text-decoration: underline;
        }

        .error-message {
            background: #fed7d7;
            color: #c53030;
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
            animation: slideInUp 0.3s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Badge flottant pour identifier le rôle */
        .role-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.9);
            color: #4facfe;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            backdrop-filter: blur(10px);
            animation: slideInDown 0.8s ease-out 0.5s both;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-grid {
                grid-template-columns: 1fr;
            }

            .left-panel {
                display: none;
            }

            .login-container {
                margin: 1rem;
                width: calc(100vw - 2rem);
            }

            .right-panel {
                padding: 2rem 1.5rem;
            }

            .welcome-text h1 {
                font-size: 2rem;
            }

            .role-badge {
                top: 10px;
                right: 10px;
                font-size: 0.7rem;
                padding: 0.4rem 0.8rem;
            }
        }

        /* Animation pour les inputs */
        .form-input {
            animation: slideInRight 0.6s ease-out;
        }

        .form-group:nth-child(1) .form-input {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) .form-input {
            animation-delay: 0.2s;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Effet de loading pour le bouton */
        .btn-login.loading {
            position: relative;
            color: transparent;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Badge de rôle -->
    <div class="role-badge">
        <i class="fas fa-chalkboard-teacher"></i> Teacher Portal
    </div>

    <!-- Particules d'arrière-plan -->
    <div class="bg-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="login-grid">
            <!-- Panel de gauche -->
            <div class="left-panel">
                <div class="logo-container">
                    <div class="logo">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="welcome-text">
                        <h1>Espace Enseignant</h1>
                        <p>Connectez-vous à votre espace pédagogique pour gérer vos cours et accompagner vos étudiants.</p>
                    </div>
                </div>
            </div>

            <!-- Panel de droite -->
            <div class="right-panel">
                <div class="form-header">
                    <h2>Connexion Enseignant</h2>
                    <p>Accédez à votre tableau de bord pédagogique</p>
                </div>

                <form id="loginForm" method="post" action="{{ route('teacher.login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse Email</label>
                        <div class="input-container">
                            <input 
                                id="email" 
                                type="email" 
                                class="form-input @error('email') is-invalid @enderror" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autocomplete="email" 
                                autofocus
                                placeholder="enseignant@ecole.fr"
                            >
                            <i class="fas fa-envelope input-icon"></i>
                        </div>
                        @error('email')
                        <div class="error-message" style="display: block;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
                        <div class="input-container">
                            <input 
                                type="password" 
                                class="form-input @error('password') is-invalid @enderror" 
                                id="password"
                                name="password" 
                                placeholder="••••••••"
                                required 
                            >
                            <i class="fas fa-lock input-icon"></i>
                        </div>
                        @error('password')
                        <div class="error-message" style="display: block;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        Se connecter
                    </button>

                    @if (Route::has('teacher.password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('teacher.password.request') }}">
                            Mot de passe oublié ?
                        </a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <script>
        // Animation du bouton de connexion
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            btn.textContent = 'Connexion...';
        });

        // Animation des inputs au focus
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Effet de parallaxe sur les particules
        document.addEventListener('mousemove', function(e) {
            const particles = document.querySelectorAll('.particle');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            particles.forEach((particle, index) => {
                const speed = (index + 1) * 0.3;
                const x = mouseX * speed * 30;
                const y = mouseY * speed * 30;
                particle.style.transform = `translate(${x}px, ${y}px)`;
            });
        });

        // Animation d'écriture pour le titre
        const title = document.querySelector('.welcome-text h1');
        const text = title.textContent;
        title.textContent = '';
        
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                title.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        };
        
        setTimeout(typeWriter, 1000);
    </script>
</body>
</html>