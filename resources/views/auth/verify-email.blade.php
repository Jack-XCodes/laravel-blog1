<x-guest-layout>
    <div class="text-center mb-4">
        <div class="mb-3">
            <i class="bi bi-envelope-check text-primary" style="font-size: 3rem;"></i>
        </div>
        <h3 class="fw-bold">Verify Your Email</h3>
        <p class="text-muted">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="d-flex flex-column gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-envelope-plus me-2"></i>Resend Verification Email
                </button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-box-arrow-right me-2"></i>Log Out
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
