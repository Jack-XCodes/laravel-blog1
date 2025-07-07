<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <div class="auth-container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <!-- Logo/Brand -->
                        <div class="text-center mb-4">
                            <a href="/" class="text-decoration-none">
                                <div class="brand-logo">
                                    <i class="bi bi-journal-text text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h2 class="h4 fw-bold text-dark mt-2">{{ config('app.name', 'Laravel') }}</h2>
                            </a>
                        </div>

                        <!-- Auth Form Card -->
                        <div class="card shadow">
                            <div class="card-body p-4">
                                {{ $slot }}
                            </div>
                        </div>

                        <!-- Footer Links -->
                        <div class="text-center mt-4">
                            <p class="text-muted small">
                                <a href="/" class="text-decoration-none text-muted">
                                    <i class="bi bi-house me-1"></i>Back to Home
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
