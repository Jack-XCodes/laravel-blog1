@extends('layouts.app')

@section('content')
<div class="welcome-hero">
    <div class="welcome-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="welcome-title">{{ config('app.name', 'Laravel') }}</h1>
                    <p class="welcome-subtitle">A modern blog platform built with Laravel. Share your thoughts, connect with others, and discover amazing content.</p>
                    
                    <div class="d-flex flex-column flex-md-row gap-3 justify-content-center align-items-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-speedometer2 me-2"></i>Go to Dashboard
                            </a>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-journal-text me-2"></i>View Blog
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="bi bi-person-plus me-2"></i>Get Started
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                            </a>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-journal-text me-2"></i>Browse Blog
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container py-5">
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2 class="display-6 fw-bold mb-3">Why Choose Our Platform?</h2>
            <p class="lead text-muted">Experience the perfect blend of simplicity and powerful features</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card text-center h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-pencil-square text-primary" style="font-size: 1.5rem;"></i>
                    </div>
                    <h5 class="card-title">Easy Writing</h5>
                    <p class="card-text text-muted">Create beautiful posts with our intuitive editor. No technical knowledge required.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people text-success" style="font-size: 1.5rem;"></i>
                    </div>
                    <h5 class="card-title">Connect</h5>
                    <p class="card-text text-muted">Engage with readers through comments and build a community around your content.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-phone text-warning" style="font-size: 1.5rem;"></i>
                    </div>
                    <h5 class="card-title">Mobile Ready</h5>
                    <p class="card-text text-muted">Your blog looks perfect on all devices. Write and read anywhere, anytime.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card text-center h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-shield-check text-info" style="font-size: 1.5rem;"></i>
                    </div>
                    <h5 class="card-title">Secure</h5>
                    <p class="card-text text-muted">Your content and data are protected with enterprise-grade security measures.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-3">Ready to Start Your Journey?</h3>
                <p class="lead text-muted mb-4">Join thousands of writers who trust our platform to share their stories with the world.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg me-3">
                        <i class="bi bi-person-plus me-2"></i>Create Account
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-eye me-2"></i>Explore Posts
                    </a>
                @else
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg me-3">
                        <i class="bi bi-plus-circle me-2"></i>Write Your First Post
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-journal-text me-2"></i>Browse All Posts
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Built with ❤️ using Laravel & Bootstrap.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="https://laravel.com" target="_blank" class="text-white-50 text-decoration-none me-3">
                    <i class="bi bi-link-45deg me-1"></i>Laravel
                </a>
                <a href="https://getbootstrap.com" target="_blank" class="text-white-50 text-decoration-none">
                    <i class="bi bi-bootstrap me-1"></i>Bootstrap
                </a>
            </div>
        </div>
    </div>
</footer>
@endsection
