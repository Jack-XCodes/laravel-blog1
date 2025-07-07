<x-guest-layout>
    <div class="text-center mb-4">
        <h3 class="fw-bold">Sign In</h3>
        <p class="text-muted">Welcome back! Please sign in to your account.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="Enter your email">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Enter your password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">
                Remember me
            </label>
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </div>

        <!-- Links -->
        <div class="text-center">
            @if (Route::has('password.request'))
                <p class="mb-2">
                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                        Forgot your password?
                    </a>
                </p>
            @endif
            
            @if (Route::has('register'))
                <p class="mb-0 text-muted">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
