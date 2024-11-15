<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'publish_date' => 'required|date',
            'author' => 'required|string|min:2|max:255',
            'content' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        try {
            // Create a new Post 
            $post = new Post();
            $post->name = $validatedData['name'];
            $post->date = $validatedData['publish_date'];
            $post->author = $validatedData['author'];
            $post->content = $validatedData['content'];
    
            // Handle the image upload
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/uploads'), $filename); 
                $post->image = 'admin/uploads/' . $filename; 
            }
    
            // Save the post to the database
            $post->save();

            session()->flash('success', 'Post created successfully!');
        
            return response()->json([
                'success' => true,
                'message' => 'Post created successfully!'
            ]);
        } catch (\Exception $e) {
            // Return error response 
            session()->flash('error', 'Failed to create post.');

            return response()->json([
                'success' => false,
                'message' => 'Failed to create post.'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id); 

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'publish_date' => 'required|date',
            'author' => 'required|string|min:2|max:255',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        try {
            $post = Post::findOrFail($id); 

            // Update post data
            $post->name = $validatedData['name'];
            $post->date = $validatedData['publish_date'];
            $post->author = $validatedData['author'];
            $post->content = $validatedData['content'];

            // Handle image upload
            if ($request->hasFile('cover_image')) {
                $image = $request->file('cover_image');
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('admin/uploads'), $filename); 
                $post->image = 'admin/uploads/' . $filename; 
            }

            $post->save();

            return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Failed to update post.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
            $post = Post::findOrFail($id);
            $post->delete();

            return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts.index')->with('error', 'Failed to delete post.');
        }
    }
}
