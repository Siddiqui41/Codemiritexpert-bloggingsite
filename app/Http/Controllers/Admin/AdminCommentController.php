<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('article')->latest()->paginate(15);
        return view('admin.comments.index', compact('comments'));
    }

    public function toggleStatus($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = $comment->status === 'approved' ? 'pending' : 'approved';
        $comment->save();

        return back()->with('success', "Comment status changed to {$comment->status}.");
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
