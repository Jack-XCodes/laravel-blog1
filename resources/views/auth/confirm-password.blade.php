<x-guest-layout>
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="bi bi-shield-lock text-warning" style="font-size: 3rem;"></i>
        </div>
        <h3 class="fw-bold">Confirm Password</h3>
        <p class="text-muted">This is a secure area of the application. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Enter your password to confirm">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-check-circle me-2"></i>Confirm
            </button>
        </div>

        <!-- Back Link -->
        <div class="text-center">
            <p class="mb-0 text-muted">
                <a href="{{ url()->previous() }}" class="text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i>Go Back
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
