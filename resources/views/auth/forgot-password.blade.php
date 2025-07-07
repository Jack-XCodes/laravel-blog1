<x-guest-layout>
    <div class="text-center mb-4">
        <h3 class="fw-bold">Reset Password</h3>
        <p class="text-muted">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
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
                   placeholder="Enter your email address">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-envelope me-2"></i>Email Password Reset Link
            </button>
        </div>

        <!-- Back to Login -->
        <div class="text-center">
            <p class="mb-0 text-muted">
                Remember your password? 
                <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
