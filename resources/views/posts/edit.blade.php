{{-- resources/views/posts/edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Post</h1>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Edit Post Form --}}
    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="title">Title</label><br>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="content">Content</label><br>
            <textarea name="content" id="content" rows="6" required style="width: 100%;">{{ old('content', $post->content) }}</textarea>
        </div>

        <button type="submit">Update Post</button>
        <a href="{{ route('dashboard') }}" style="margin-left: 10px;">← Back to Dashboard</a>
    </form>

</div>
@endsection
