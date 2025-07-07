{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Top Header -->
    <div class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                <p class="text-sm text-gray-500 mt-1">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    @if(Auth::user()->profile_photo_path)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                             class="w-10 h-10 rounded-full object-cover">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-sm font-semibold text-white">{{ substr(Auth::user()->name, 0, 2) }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6">
        <!-- Stats Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Posts -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Posts</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($posts->count()) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm text-green-600 font-medium">+{{ $posts->where('created_at', '>=', now()->subWeek())->count() }}</span>
                    <span class="text-sm text-gray-500 ml-2">this week</span>
                </div>
            </div>

            <!-- Total Views -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Views</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($posts->count() * 156) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm text-green-600 font-medium">+12.5%</span>
                    <span class="text-sm text-gray-500 ml-2">vs last month</span>
                </div>
            </div>

            <!-- Comments -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Comments</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($posts->sum(function($post) { return $post->comments->count(); })) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm text-green-600 font-medium">+{{ $posts->sum(function($post) { return $post->comments->where('created_at', '>=', now()->subWeek())->count(); }) }}</span>
                    <span class="text-sm text-gray-500 ml-2">this week</span>
                </div>
            </div>

            <!-- Engagement -->
            <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Engagement</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $posts->count() > 0 ? number_format(($posts->sum(function($post) { return $post->comments->count(); }) / max($posts->count(), 1)) * 100, 1) : 0 }}%</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-sm text-green-600 font-medium">+8.2%</span>
                    <span class="text-sm text-gray-500 ml-2">improvement</span>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Charts & Analytics -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Chart Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Post Analytics</h3>
                        <div class="flex items-center space-x-2">
                            <select class="text-sm border border-gray-300 rounded-lg px-3 py-2">
                                <option>Last 7 days</option>
                                <option>Last 30 days</option>
                                <option>Last 3 months</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Simple Chart Visualization -->
                    <div class="h-64 flex items-end justify-between space-x-2">
                        @php
                            $chartData = [];
                            for($i = 6; $i >= 0; $i--) {
                                $date = now()->subDays($i);
                                $count = $posts->filter(function($post) use ($date) {
                                    return $post->created_at->isSameDay($date);
                                })->count();
                                $chartData[] = ['day' => $date->format('M j'), 'count' => $count, 'height' => max($count * 40, 20)];
                            }
                        @endphp
                        
                        @foreach($chartData as $data)
                            <div class="flex-1 flex flex-col items-center">
                                <div class="w-full bg-gradient-to-t from-pink-500 to-purple-600 rounded-t-lg mb-2" 
                                     style="height: {{ $data['height'] }}px;"></div>
                                <span class="text-xs text-gray-500">{{ $data['day'] }}</span>
                                <span class="text-xs text-gray-700 font-medium">{{ $data['count'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Recent Posts</h3>
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 text-white text-sm font-medium rounded-lg hover:bg-pink-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                New Post
                            </a>
                        </div>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @forelse($posts->take(5) as $post)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="text-base font-medium text-gray-900 mb-1">
                                            <a href="{{ route('posts.show', $post) }}" class="hover:text-pink-600 transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h4>
                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ Str::limit($post->content, 100) }}
                                        </p>
                                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ $post->created_at->format('M j, Y') }}
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                {{ $post->comments->count() }} comments
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2 ml-4">
                                        <a href="{{ route('posts.edit', $post) }}" class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-lg font-medium text-gray-900 mb-2">No posts yet</h4>
                                <p class="text-gray-600 mb-4">Get started by creating your first blog post.</p>
                                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 text-white text-sm font-medium rounded-lg hover:bg-pink-700 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Create Post
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('posts.create') }}" class="w-full flex items-center p-3 bg-gradient-to-r from-pink-500 to-purple-600 text-white rounded-lg hover:from-pink-600 hover:to-purple-700 transition-all">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Write New Post
                        </a>
                        <a href="{{ route('posts.index') }}" class="w-full flex items-center p-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            View All Posts
                        </a>
                        <a href="{{ route('profile.edit') }}" class="w-full flex items-center p-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </a>
                    </div>
                </div>

                <!-- Activity Feed -->
                @if($posts->isNotEmpty())
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @foreach($posts->take(3) as $post)
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-pink-500 rounded-full mt-2 flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900 font-medium">Published new post</p>
                                <p class="text-sm text-gray-600 truncate">{{ Str::limit($post->title, 40) }}</p>
                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Profile Section -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile</h3>
                    <div class="text-center">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" 
                                 class="w-16 h-16 rounded-full mx-auto mb-3 object-cover">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full mx-auto mb-3 flex items-center justify-center">
                                <span class="text-lg font-semibold text-white">{{ substr(Auth::user()->name, 0, 2) }}</span>
                            </div>
                        @endif
                        <h4 class="font-medium text-gray-900">{{ Auth::user()->name }}</h4>
                        <p class="text-sm text-gray-500">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
                        
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf
                            <input type="file" name="profile_photo" accept="image/*" class="hidden" id="profile_photo">
                            <label for="profile_photo" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 cursor-pointer transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Change Photo
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-submit profile photo form when file is selected
document.getElementById('profile_photo').addEventListener('change', function() {
    if (this.files && this.files[0]) {
        this.closest('form').submit();
    }
});
</script>
@endsection

