<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CommentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = new Comment($validated);
        $comment->user_id = auth()->id();
        $comment->post_id = $post->id;
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|max:1000'
        ]);

        $comment->update($validated);

        return back()->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
} 