@extends('layouts.app')

@section('content')
<!-- Modern Hero Section -->
<div class="hero-section relative">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">
                Welcome to Our 
                <span class="bg-gradient-to-r from-yellow-400 to-pink-400 bg-clip-text text-transparent">
                    Blog
                </span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed">
                Discover amazing stories, insights, and knowledge shared by our community of writers and creators.
            </p>
            @auth
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('posts.create') }}" class="btn-primary inline-flex items-center justify-center group">
                        <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Write New Post
                    </a>
                    <a href="#posts" class="btn-outline text-white border-white hover:bg-white hover:text-purple-600">
                        Explore Posts
                    </a>
                </div>
            @else
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="btn-primary">
                        Join Our Community
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline text-white border-white hover:bg-white hover:text-purple-600">
                        Sign In
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <!-- Background pattern -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple-900 via-blue-900 to-indigo-900"></div>
    <div class="absolute inset-0 bg-black/20"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
</div>

<!-- Posts Section -->
<div id="posts" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    @if($posts->count() > 0)
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Latest Stories</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Dive into our collection of thoughtfully crafted articles and insights
            </p>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" data-animate>
            @foreach($posts as $post)
                <article class="blog-card group">
                    <!-- Image Section -->
                    <div class="relative overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 alt="{{ $post->title }}" 
                                 class="blog-card-img">
                        @else
                            <div class="h-48 bg-gradient-to-br from-purple-500 via-blue-500 to-indigo-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Hover overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Content Section -->
                    <div class="p-6 flex flex-col flex-1">
                        <!-- Meta Information -->
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white text-xs font-semibold mr-3">
                                    {{ substr($post->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-gray-700">{{ $post->user->name }}</span>
                            </div>
                            <span class="mx-2">•</span>
                            <time class="text-gray-500">{{ $post->created_at->format('M j, Y') }}</time>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300 line-clamp-2">
                            {{ $post->title }}
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 mb-4 flex-1 line-clamp-3 leading-relaxed">
                            {{ Str::limit($post->excerpt, 150) }}
                        </p>

                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <!-- Stats -->
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    <span class="badge badge-secondary">{{ $post->comments_count ?? 0 }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="badge badge-info">{{ ceil(str_word_count($post->content) / 200) }} min</span>
                                </div>
                            </div>

                            <!-- Read More Button -->
                            <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center text-purple-600 hover:text-purple-800 font-semibold group">
                                Read More
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="flex justify-center mt-16">
                <nav class="flex items-center space-x-2">
                    {{ $posts->links('pagination::tailwind') }}
                </nav>
            </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="max-w-md mx-auto">
                <!-- Icon -->
                <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>

                <!-- Content -->
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Posts Yet</h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Be the first to share your thoughts and stories with our community. Your voice matters!
                </p>

                <!-- Actions -->
                @auth
                    <a href="{{ route('posts.create') }}" class="btn-primary inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Your First Post
                    </a>
                @else
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="btn-primary">Join Our Community</a>
                        <a href="{{ route('login') }}" class="btn-outline">Sign In</a>
                    </div>
                @endauth
            </div>
        </div>
    @endif
</div>

<!-- Call to Action Section -->
<div class="bg-gradient-to-r from-purple-600 to-blue-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Ready to Share Your Story?
        </h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
            Join thousands of writers and creators who are already sharing their insights with our community.
        </p>
        @auth
            <a href="{{ route('posts.create') }}" class="btn-primary bg-white text-purple-600 hover:bg-gray-100">
                Start Writing Today
            </a>
        @else
            <a href="{{ route('register') }}" class="btn-primary bg-white text-purple-600 hover:bg-gray-100">
                Join Our Community
            </a>
        @endauth
    </div>
</div>
@endsection 