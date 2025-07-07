<p class="text-muted mb-4">Ensure your account is using a long, random password to stay secure.</p>

<form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">Current Password</label>
            <input type="password" 
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_current_password" 
                   name="current_password" 
                   autocomplete="current-password"
                   placeholder="Enter your current password">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="update_password_password" class="form-label">New Password</label>
            <input type="password" 
                   class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_password" 
                   name="password" 
                   autocomplete="new-password"
                   placeholder="Enter your new password">
            @error('password', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" 
                   class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                   id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   autocomplete="new-password"
                   placeholder="Confirm your new password">
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Submit Button and Status -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-key me-2"></i>Update Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small">
                    <i class="bi bi-check-circle me-1"></i>Password updated successfully!
                </span>
            @endif
        </div>
</form>
