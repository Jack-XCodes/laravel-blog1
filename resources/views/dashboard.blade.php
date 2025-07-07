{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-5 fw-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="mb-0 opacity-75">Ready to share your thoughts with the world?</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                             class="rounded-circle me-3" 
                             width="60" 
                             height="60"
                             style="object-fit: cover;">
                    @else
                        <div class="bg-white bg-opacity-20 rounded-circle me-3 d-flex align-items-center justify-content-center"
                             style="width: 60px; height: 60px;">
                            <i class="bi bi-person text-white" style="font-size: 1.5rem;"></i>
                        </div>
                    @endif
                    <div>
                        <small class="d-block opacity-75">Member since</small>
                        <small class="fw-semibold">{{ Auth::user()->created_at->format('M Y') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Dashboard Stats -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <span class="stat-number">{{ $posts->count() }}</span>
            <div class="stat-label">
                <i class="bi bi-journal-text me-1"></i>
                {{ Str::plural('Post', $posts->count()) }}
            </div>
        </div>
        
        <div class="stat-card">
            <span class="stat-number">{{ $posts->sum(function($post) { return $post->comments->count(); }) }}</span>
            <div class="stat-label">
                <i class="bi bi-chat-dots me-1"></i>
                {{ Str::plural('Comment', $posts->sum(function($post) { return $post->comments->count(); })) }}
            </div>
        </div>
        
        <div class="stat-card">
            <span class="stat-number">{{ $posts->where('created_at', '>=', now()->subDays(30))->count() }}</span>
            <div class="stat-label">
                <i class="bi bi-calendar-week me-1"></i>
                Posts This Month
            </div>
        </div>
        
        <div class="stat-card">
            <span class="stat-number">{{ $posts->isNotEmpty() ? $posts->first()->created_at->diffInDays(now()) + 1 : 0 }}</span>
            <div class="stat-label">
                <i class="bi bi-calendar3 me-1"></i>
                Days Active
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Write New Post
                        </a>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-journal-text me-2"></i>View All Posts
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-person-gear me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Photo Upload -->
        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-person-circle me-2"></i>Profile Photo
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                                     class="rounded-circle mb-3" 
                                     width="100" 
                                     height="100"
                                     style="object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                     style="width: 100px; height: 100px;">
                                    <i class="bi bi-person text-muted" style="font-size: 2rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="profile_photo" class="form-label">
                                        Choose new profile photo
                                    </label>
                                    <input type="file" 
                                           class="form-control" 
                                           id="profile_photo" 
                                           name="profile_photo" 
                                           accept="image/*">
                                    <div class="form-text">
                                        Upload a photo to personalize your profile. JPG, PNG or GIF (max 2MB).
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-upload me-2"></i>Upload Photo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-journal-text me-2"></i>Your Recent Posts
                    </h5>
                    <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus me-1"></i>New Post
                    </a>
                </div>
                <div class="card-body p-0">
                    @forelse($posts as $post)
                        <div class="border-bottom p-4 {{ !$loop->last ? '' : 'border-0' }}">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-2">
                                        <a href="{{ route('posts.show', $post) }}" 
                                           class="text-decoration-none text-dark">
                                            {{ $post->title }}
                                        </a>
                                    </h6>
                                    <p class="text-muted mb-2 small">
                                        {{ Str::limit($post->content, 120) }}
                                    </p>
                                    <div class="d-flex align-items-center gap-3 small text-muted">
                                        <span>
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $post->created_at->format('M j, Y') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-chat-dots me-1"></i>
                                            {{ $post->comments->count() }} {{ Str::plural('comment', $post->comments->count()) }}
                                        </span>
                                        <span>
                                            <i class="bi bi-eye me-1"></i>
                                            <a href="{{ route('posts.show', $post) }}" class="text-muted text-decoration-none">
                                                View Post
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('posts.edit', $post) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                            <span class="d-none d-sm-inline ms-1">Edit</span>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                                <span class="d-none d-sm-inline ms-1">Delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="bi bi-journal-plus text-muted" style="font-size: 4rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">No posts yet</h5>
                            <p class="text-muted mb-4">Start sharing your thoughts with the world!</p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Create Your First Post
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Feed (if there are posts) -->
    @if($posts->isNotEmpty())
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-activity me-2"></i>Recent Activity
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($posts->take(5) as $post)
                        <div class="list-group-item border-0 px-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle me-3 d-flex align-items-center justify-content-center"
                                     style="width: 40px; height: 40px;">
                                    <i class="bi bi-journal-text text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold">Published "{{ $post->title }}"</div>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    View
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

