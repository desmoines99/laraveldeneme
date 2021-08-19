<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $comments = Comment::latest()->with(['user', 'posts' ,'replies']);

        return view('comments.index', [
            'comments' => $comments
        ]);
    }

    public function show(Post $post, Comment $comment)
    {
        return view('posts.show', [
            'comment' => $comment
        ]);
    }

    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        
        $comment = new Comment();

        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());

        $comment->body=$request->body;
        
        $comment->save();

        return back();

    }

    public function destroy(Comment $comment)
    {
        

        $comment->delete();

        return back();
    }
}
