<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $posts = Post::latest()->with(['user', 'likes', 'dislikes', 'comments'])->paginate(20);

        // return $posts;
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post,)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
        ]);

        // $request->user()->posts()->create($request->all());

        $inputs = $request->only([
            'title', 'image', 'body'
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;

        $post->user()->associate(auth()->user());

        if (isset($request->image)) {
            $path = $request->file('image')->store('public/images');
            $post->image = $path;
        }

        $post->save();


        return back();
        // return response()->json($request);

        // return Post::create($request->all());
    }



    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect('/');
    }
}
