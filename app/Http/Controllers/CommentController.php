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
        if($post->commentedBy($request->user())){
            return response(null,409);
        }
        
        $this->validate($request, [
            'body' => 'required'
        ]);

        $comment = new Comment();

        $comment->post()->associate($post);
        $comment->user()->associate(auth()->user());

        $comment->body=$request->body;
        // dd($comment);
        $comment->save();


        

        // $post->comments()->create([
        //     'user_id' => $request->user()->id,
        // ]);

        
        // $comment()->create($request->only('body'));

        return back();

    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
