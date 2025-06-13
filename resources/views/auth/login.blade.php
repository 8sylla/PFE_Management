<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="images/user.png"/>
    
    <!-- Bootstrap & Custom Styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
        }
        .card-img {
            object-fit: cover;
            height: 100%;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            background: #007bff;
            border: none;
            font-weight: 500;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .text-danger {
            font-size: 0.9rem;
        }
        .login-title {
            font-weight: bold;
            color: #1e293b;
        }
    </style>
</head>
<body>

<section class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="row g-0">
                    <!-- Image -->
<!-- Image -->
<div class="col-md-6 d-none d-md-block" style="
    background-image: url('{{ asset('images_profil/back.jpg') }}');
    background-size: cover;
    background-position: 20% center;
    min-height: 100%;
">
</div>


                    <!-- Form -->
                    <div class="col-md-6">
                        <div class="card-body p-4 p-md-5">
                            <div class="mb-4 text-center">
                                <h2 class="login-title">Welcome Back</h2>
                                <p class="text-muted">Please log in to continue</p>
                            </div>

                            <x-auth-session-status :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••••">
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                                    <label class="form-check-label" for="remember_me">Remember me</label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Log in</button>
                                </div>
                            </form>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('register') }}" class="text-decoration-none">Create new account</a>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div> <!-- row -->
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
