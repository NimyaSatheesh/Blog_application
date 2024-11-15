@extends('admin.layouts.master')
<link rel="stylesheet" href="{{ asset('assets/admin/css/post_form.css') }}">

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="post-form">
            <h2>Post Entry</h2>

            <!-- form begin here -->
            <div class="w3-container">
                <form action="{{ route('admin.posts.store') }}" method="POST" id="postForm" enctype="multipart/form-data">
                    @csrf
                    <div class="post-details">

                        <!-- Post Name -->
                        <div class="input-box">
                            <span class="details">Name</span>
                            <input type="text" name="name" id="name" placeholder="Enter post title" value="{{ old('name') }}" autofocus>
                            <span class="text-danger" id="name-error"></span>
                        </div>

                        <!-- Publish Date -->
                        <div class="input-box">
                            <span class="details">Publish Date</span>
                            <input type="date" name="publish_date" placeholder="Select publish date" value="{{ old('publish_date') }}" autofocus>
                            <span class="text-danger" id="publish_date-error"></span>
                        </div>

                        <!-- Post Author -->
                        <div class="input-box">
                            <span class="details">Author</span>
                            <input type="text" name="author" placeholder="Enter author name" value="{{ old('author') }}" autofocus>
                            <span class="text-danger" id="author-error"></span>
                        </div>

                    </div>  

                    <div class="post-content-details">

                        <!-- Post Content -->
                        <div class="input-box">
                            <span class="details">Content</span>
                            <textarea name="content" placeholder="Enter content">{{ old('content') }}</textarea>
                            <span class="text-danger" id="content-error"></span>
                        </div>

                        <!-- Cover Image -->
                        <div class="input-box">
                            <span class="details">Cover Image</span>
                            <input type="file" name="cover_image" id="cover_image" value="{{ old('cover_image') }}" autofocus>
                            <span class="text-danger" id="cover_image-error"></span>
                  
                        </div>

                        <!-- Image Preview -->
                        <div class="image-preview" id="imagePreview"></div>
                    </div>

                    <!-- Submit Button -->
                    <div class="button">
                        <input type="submit" name="submit_btn" value="Submit">
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
        });

        // Handle Form Submission with AJAX
        $('#postForm').on('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.posts.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        window.location.href = "{{ route('admin.posts.index') }}";
                        // Show success message
                        $('#message').html('<div class="alert alert-success" style="color: green; text-align:center;">' + response.message + '</div>');

                    }
                },
                error: function(xhr) {
                    // Display validation errors 
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, error) {
                        $('#' + key + '-error').text(error[0]);
                    });
                }
            });
        });
    });
</script>
@endsection
