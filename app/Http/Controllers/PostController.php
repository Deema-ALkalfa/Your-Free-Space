<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10); // Adjust the number to how many posts per page you want
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => Auth::id(), // Assuming the post is associated with the logged-in user
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);

        // Check if the current user is the owner of the post
        $isOwner = $post->user_id === Auth::id();

        // Retrieve comments based on visibility and ownership
        $comments = $post->comments->filter(function ($comment) use ($isOwner) {
            return $isOwner || $comment->status === 'visible';
        });

        return view('posts.show', compact('post', 'comments', 'isOwner'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048', // Validate the image
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $post->image,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image); // Delete image from storage
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }


    public function __construct()
{
    $this->middleware('auth')->except(['index', 'show']);
}

}
