<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PFE Management</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Style -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.3);
        }

        .animated-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #6b8dd6, #5569c9);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center text-white">

    <div class="animated-bg"></div>

    <div class="text-center z-10 px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 drop-shadow-lg">🎓 Welcome to PFE Management</h1>

        @if (Route::has('login'))
            @auth
                <div class="glass-card inline-block">
                    <a href="{{ url('/dashboard') }}" class="flex flex-col items-center">
                        <img src="images/user.png" class="w-16 h-16 mb-2" alt="Dashboard" />
                        <span class="text-lg font-semibold">Go to Dashboard</span>
                    </a>
                </div>
            @else
                <div class="flex flex-wrap justify-center gap-6 mt-8">
                    <!-- Student -->
                    <div class="glass-card w-48">
                        <a href="{{ route('login') }}" class="flex flex-col items-center">
                            <img src="images/user.png" class="w-14 h-14 mb-2" alt="Student" />
                            <span>Login Student</span>
                        </a>
                    </div>

                    <!-- Teacher -->
                    <div class="glass-card w-48">
                        <a href="{{ route('teacher.login') }}" class="flex flex-col items-center">
                            <img src="images/Teacher.png" class="w-14 h-14 mb-2" alt="Teacher" />
                            <span>Login Supervisor</span>
                        </a>
                        @if (Route::has('teacher.register'))
                            <a href="{{ route('teacher.register') }}" class="text-sm text-blue-200 mt-2 hover:underline">Register</a>
                        @endif
                    </div>

                    <!-- Admin -->
                    <div class="glass-card w-48">
                        <a href="{{ route('admin.login') }}" class="flex flex-col items-center">
                            <img src="images/AdminRo.png" class="w-14 h-14 mb-2" alt="Admin" />
                            <span>Login Admin</span>
                        </a>
                        @if (Route::has('admin.register'))
                            <a href="{{ route('admin.register') }}" class="text-sm text-blue-200 mt-2 hover:underline">Register</a>
                        @endif
                    </div>
                </div>
            @endauth
        @endif
    </div>
</body>
</html>
