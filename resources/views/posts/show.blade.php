@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
        @can('update', $post)
        <div class="flex gap-4">
            <a href="{{ route('posts.edit', $post) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Edit Post') }}
            </a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('{{ __('Are you sure you want to delete this post?') }}')">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
        @endcan
    </div>
@endsection

@section('content')
<div class="container py-5">
    <!-- Back Navigation -->
    <div class="mb-4">
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Blog
        </a>
    </div>

    <!-- Post Content -->
    <article class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                @if($post->featured_image)
                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 400px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <!-- Post Header -->
                    <header class="mb-4">
                        <h1 class="display-5 fw-bold mb-3">{{ $post->title }}</h1>
                        
                        <div class="d-flex flex-wrap align-items-center gap-3 text-muted mb-3">
                            <div class="d-flex align-items-center">
                                <div class="comment-avatar me-2">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <span>{{ $post->user->name }}</span>
                            </div>
                            <span>•</span>
                            <span><i class="bi bi-calendar me-1"></i>{{ $post->created_at->format('F j, Y') }}</span>
                            <span>•</span>
                            <span><i class="bi bi-clock me-1"></i>{{ ceil(str_word_count($post->content) / 200) }} min read</span>
                            <span>•</span>
                            <span><i class="bi bi-chat me-1"></i>{{ $post->comments->count() }} comments</span>
                        </div>

                        @if($post->excerpt)
                            <div class="alert alert-light border-start border-primary border-4 fs-5">
                                {{ $post->excerpt }}
                            </div>
                        @endif
                    </header>

                    <!-- Post Content -->
                    <div class="prose">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Post Actions -->
                    @auth
                        @if(auth()->user()->id === $post->user_id)
                            <div class="border-top pt-4 mt-5">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">
                                        <i class="bi bi-pencil me-1"></i>Edit Post
                                    </a>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                            <i class="bi bi-trash me-1"></i>Delete Post
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Social Sharing -->
            <div class="card mt-4 border-0 bg-light">
                <div class="card-body text-center">
                    <h6 class="card-title">Share this post</h6>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                           target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-twitter me-1"></i>Twitter
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-facebook me-1"></i>Facebook
                        </a>
                        <button class="btn btn-outline-secondary btn-sm" onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Link copied to clipboard!')">
                            <i class="bi bi-link-45deg me-1"></i>Copy Link
                        </button>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card mt-5 border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="mb-0">
                        <i class="bi bi-chat-dots me-2"></i>Comments ({{ $post->comments->count() }})
                    </h4>
                </div>
                <div class="card-body">
                    @auth
                        <!-- Comment Form -->
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="mb-3">
                                <label for="content" class="form-label">Add a comment</label>
                                <textarea name="content" id="content" rows="3" 
                                        class="form-control @error('content') is-invalid @enderror" 
                                        placeholder="Share your thoughts..." required>{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send me-1"></i>Post Comment
                            </button>
                        </form>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            <a href="{{ route('login') }}" class="alert-link">Sign in</a> to join the conversation or 
                            <a href="{{ route('register') }}" class="alert-link">create an account</a> if you don't have one.
                        </div>
                    @endauth

                    <!-- Comments List -->
                    @forelse($post->comments as $comment)
                        <div class="border-bottom pb-3 mb-3">
                            <div class="d-flex align-items-start">
                                <div class="comment-avatar me-3">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0 me-2">{{ $comment->user->name }}</h6>
                                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        @auth
                                            @if(auth()->user()->id === $comment->user_id)
                                                <div class="ms-auto">
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure?')">
                                                                        <i class="bi bi-trash me-1"></i>Delete
                                                                    </button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="mb-0">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-chat text-muted mb-3" style="font-size: 3rem;"></i>
                            <p class="text-muted">No comments yet. Be the first to share your thoughts!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </article>
</div>
@endsection 