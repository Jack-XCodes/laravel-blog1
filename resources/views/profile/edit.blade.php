@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Page Header -->
            <div class="mb-4">
                <h1 class="h2 fw-bold mb-1">Profile Settings</h1>
                <p class="text-muted mb-0">Manage your account settings and personal information.</p>
            </div>

            <!-- Update Profile Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-person-circle me-2 text-primary"></i>Profile Information
                    </h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-key me-2 text-warning"></i>Change Password
                    </h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-light py-3">
                    <h5 class="card-title mb-0 fw-semibold text-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>Danger Zone
                    </h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
