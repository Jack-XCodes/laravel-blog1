{{-- resources/views/posts/edit.blade.php --}}

@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Edit Post') }}
    </h2>
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i>Edit Post
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Title *</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $post->title) }}" 
                                   placeholder="Enter an engaging title for your post" 
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-4">
                            <label for="excerpt" class="form-label fw-semibold">Excerpt</label>
                            <textarea name="excerpt" 
                                      id="excerpt" 
                                      rows="3" 
                                      class="form-control @error('excerpt') is-invalid @enderror" 
                                      placeholder="Write a brief summary of your post (optional)">{{ old('excerpt', $post->excerpt) }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">A compelling excerpt helps readers understand what your post is about.</div>
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <label for="content" class="form-label fw-semibold">Content *</label>
                            <textarea name="content" 
                                      id="content" 
                                      rows="12" 
                                      class="form-control @error('content') is-invalid @enderror" 
                                      placeholder="Share your thoughts, experiences, or knowledge..." 
                                      required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Write in markdown or plain text. Express yourself freely!</div>
                        </div>

                        <!-- Current Image Display -->
                        @if($post->featured_image)
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Current Featured Image</label>
                                <div class="border rounded p-3 bg-light">
                                    <div class="row align-items-center">
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                 class="img-fluid rounded" 
                                                 alt="Current featured image"
                                                 style="max-height: 120px; object-fit: cover;">
                                        </div>
                                        <div class="col-md-8">
                                            <p class="mb-2 text-muted">Current image will be replaced if you upload a new one.</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                                <label class="form-check-label text-danger" for="remove_image">
                                                    <i class="bi bi-trash me-1"></i>Remove current image
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Featured Image Upload -->
                        <div class="mb-4">
                            <label for="featured_image" class="form-label fw-semibold">
                                {{ $post->featured_image ? 'Replace Featured Image' : 'Featured Image' }}
                            </label>
                            <div class="border border-2 border-dashed border-secondary rounded p-4 text-center bg-light">
                                <input type="file" 
                                       name="featured_image" 
                                       id="featured_image" 
                                       class="form-control d-none @error('featured_image') is-invalid @enderror" 
                                       accept="image/*">
                                <div id="image-drop-zone" class="image-upload-area" onclick="document.getElementById('featured_image').click()">
                                    <i class="bi bi-cloud-upload text-secondary mb-3" style="font-size: 3rem;"></i>
                                    <p class="mb-2"><strong>Click to upload</strong> or drag and drop</p>
                                    <p class="text-muted small">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <div id="image-preview" class="d-none mt-3">
                                    <img id="preview-img" src="" class="img-fluid rounded" style="max-height: 200px;">
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="clearImagePreview()">
                                        <i class="bi bi-trash me-1"></i>Remove
                                    </button>
                                </div>
                            </div>
                            @error('featured_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Cancel
                            </a>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Update Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Post Section -->
            <div class="card mt-4 border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>Danger Zone
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Once you delete this post, there is no going back. Please be certain.</p>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger" 
                                onclick="return confirm('Are you absolutely sure you want to delete this post? This action cannot be undone.')">
                            <i class="bi bi-trash me-1"></i>Delete Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-drop-zone').classList.add('d-none');
            document.getElementById('image-preview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

function clearImagePreview() {
    document.getElementById('featured_image').value = '';
    document.getElementById('image-drop-zone').classList.remove('d-none');
    document.getElementById('image-preview').classList.add('d-none');
}

// Drag and drop functionality
const dropZone = document.getElementById('image-drop-zone');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    this.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    this.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    this.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('featured_image').files = files;
        document.getElementById('featured_image').dispatchEvent(new Event('change'));
    }
});

// Handle remove image checkbox
document.getElementById('remove_image')?.addEventListener('change', function() {
    if (this.checked) {
        // Clear any new image selection
        document.getElementById('featured_image').value = '';
        clearImagePreview();
    }
});
</script>
@endsection
