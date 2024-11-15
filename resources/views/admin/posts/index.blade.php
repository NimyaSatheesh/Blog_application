@extends('admin.layouts.master')
<link rel="stylesheet" href="{{ asset('/assets/admin/css/post_view.css') }}">

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="main_div" style="max-width:1564px">
                <div class="post_list">

                    <!-- Display Success or Error Message from Session -->
                    @if(session('success'))
                        <div class="alert alert-success" style="color: green; text-align:center;">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="alert alert-danger" style="color: red; text-align:center;">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Search Section -->
                    <div class="search-section">
                        <label for="search">Search post Here : </label>
                        <input type="text" id="searchQuery" name="search" placeholder="Search post here" value="{{ request('search') }}">
                    </div>

                    <button class="add_btn">
                        <a href="{{ route('admin.posts.create') }}" style="color: #fff;"> + New Entry</a>
                    </button><br><br>

                    <div class="row">
                        <!-- Table to display all posts -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Publish Date</th>
                                    <th>Author</th>
                                    <th>Content</th>
                                    <th>Cover Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="postTableBody">
                                @foreach($posts as  $key =>  $post)
                                    <tr class="post-item">
                                        <td>{{ $loop->iteration}}</td>
                                        <td>{{ $post->name }}</td>
                                        <td>{{ $post->date }}</td>
                                        <td>{{ $post->author }}</td>
                                        <td>{{ $post->content }}</td>
                                        <td>
                                            @if($post->image)
                                                <img src="{{ asset($post->image) }}" alt="Cover Image" style="width: 100px;">
                                            @else
                                                No image
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('admin.posts.delete', $post->id) }}" method="POST" class="delete-form" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirmDeletion()">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <div id="noDataFound" style="display: none;">
                                    No data found
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Confirmation before deleting
        function confirmDeletion() {
            return confirm('Are you sure you want to delete this post?');
        }

        $(document).ready(function() {
            $('#searchQuery').keyup(function() {
                var searchText = $(this).val().toLowerCase();
                var anyPostFound = false; 

                // Loop through all the table rows and check if the post matches the search query
                $('.post-item').each(function() {
                    var postText = $(this).text().toLowerCase();
                    var isPostMatch = postText.includes(searchText);
                    $(this).toggle(isPostMatch); 

                    if (isPostMatch) {
                        anyPostFound = true; 
                    }
                });

                // If no post is found, show 'No data found' message
                if (!anyPostFound) {
                    $('#noDataFound').show();
                } else {
                    $('#noDataFound').hide();
                }
            });
        });
    </script>
@endsection
