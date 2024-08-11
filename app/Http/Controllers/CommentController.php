<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    // Update the status of a comment
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:visible,hidden',
        ]);

        $comment = Comment::findOrFail($id);
        $post = $comment->post;

        // Ensure the user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You do not have permission to update this comment.');
        }

        $comment->status = $request->status;
        $comment->save();

        return redirect()->back()->with('success', 'Comment status updated successfully');
    }

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post = $comment->post;

        // Ensure the user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You do not have permission to delete this comment.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
