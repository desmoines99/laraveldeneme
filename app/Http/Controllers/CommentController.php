<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment();

        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());

        $comment->body = $request->body;

        $comment->save();

        return back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
