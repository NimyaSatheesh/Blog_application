@extends('admin.layouts.master')
<link rel="stylesheet" href="{{ asset('assets/admin/css/post_form.css') }}">

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="post-form">
            <h2>Edit Post</h2>

            <!-- Success or Error Message Display -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Form for editing the post -->
            <div class="w3-container">
                <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" id="postForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="post-details">

                        <!-- Post Name -->
                        <div class="input-box">
                            <span class="details">Name</span>
                            <input type="text" name="name" id="name" placeholder="Enter post title" value="{{ old('name', $post->name) }}" autofocus>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                        
                        </div>

                        <!-- Publish Date -->
                        <div class="input-box">
                            <span class="details">Publish Date</span>
                            <input type="date" name="publish_date" placeholder="Select publish date" value="{{ old('publish_date', $post->date) }}" autofocus>
                            @error('publish_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div>

                        <!-- Post Author -->
                        <div class="input-box">
                            <span class="details">Author</span>
                            <input type="text" name="author" placeholder="Enter author name" value="{{ old('author', $post->author) }}" autofocus>
                            @error('author')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div>

                    </div>  

                    <div class="post-content-details">

                        <!-- Post Content -->
                        <div class="input-box">
                            <span class="details">Content</span>
                            <textarea name="content" placeholder="Enter content">{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror 
                        </div>

                        <!-- Cover Image (Optional) -->
                        <div class="input-box">
                            <span class="details">Cover Image</span>
                            <input type="file" name="cover_image" id="cover_image">
                            @if($post->image)
                                <img src="{{ asset($post->image) }}" alt="Cover Image" style="max-width: 100px; margin-top: 10px;">
                            @endif
                            <span class="text-danger" id="cover_image-error"></span>
                        </div>
                        <div class="image-preview" id="imagePreview"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="button">
                        <input type="submit" name="submit_btn" value="Update">
                    </div>
                       <!-- Cancel Button -->
                    <div class="button">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        // Handle Image Preview
        document.getElementById('cover_image').addEventListener('change', function(event) {
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = ''; // Clear previous preview

            var file = event.target.files[0]; // Get the first selected file
            if (file && file.type.startsWith('image/')) { 
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.createElement('img'); 
                    img.src = e.target.result; 
                    img.style.maxWidth = '300px'; 
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        })
    });
</script>
@endsection
