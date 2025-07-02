{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Success Message --}}
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Welcome, {{ Auth::user()->name }}</h1>

    {{-- Profile Picture --}}
    <div style="margin-bottom: 20px;">
        <h3>Your Profile Picture</h3>
        @if(Auth::user()->profile_photo_path)
            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" width="100" height="100" style="border-radius: 50%;">
        @else
            <p>No profile picture uploaded.</p>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
            @csrf
            <input type="file" name="profile_photo">
            <button type="submit">Upload</button>
        </form>
    </div>

    <hr>

    {{-- Create New Post --}}
    <h2>Create New Post</h2>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <input type="text" name="title" placeholder="Post Title" required style="width: 100%; margin-bottom: 10px;">
        </div>
        <div>
            <textarea name="content" placeholder="Post Content" required style="width: 100%; height: 100px;"></textarea>
        </div>
        <button type="submit" style="margin-top: 10px;">Publish</button>
    </form>

    <hr>

    {{-- List of Posts --}}
    <h2>Your Posts</h2>
    @forelse($posts as $post)
        <div style="border: 1px solid #ccc; padding: 15px; margin-top: 15px;">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            <small>Published at: {{ $post->created_at->format('d M Y, H:i') }}</small>
            <div style="margin-top: 10px;">
                <a href="{{ route('posts.edit', $post) }}">Edit</a>

                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <p>You haven’t posted anything yet.</p>
    @endforelse

</div>
@endsection

