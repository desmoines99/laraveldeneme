<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts()->with(['user', 'likes', 'dislikes'])->paginate(20);
        
        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function store(Request $request, User $user)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $user->posts()->create($request->only('body'));

        return response()->json([
            'message' => 'succes',    
        ])->status(200);

    }

    public function comment(Request $request, Post $post, Comment $comment)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment();

        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());

        $comment->body = $request->body;
        
        $comment->save();

        return response()->json([
            'message' => 'succes',    
        ])->status(200);

    }
}
