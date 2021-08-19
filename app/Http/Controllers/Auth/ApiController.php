<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'username' => 'required|max:255',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'username'=> $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        
        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function posts()
    {
        $posts = Post::latest()->with(['user', 'likes', 'dislikes','comments'])->get();

        // return $posts;
        return $posts;
    }

    public function updatepost(Request $request, $data)
    {
        $post = Post::find($data);
        $post->update($request->all());
        return $post;
        
    }

    // public function comments(Post $post, Request $request)
    // {
    //     $this->validate($request, [
    //         'body' => 'required'
    //     ]);

        
    //     $comment = new Comment();

    //     $comment->post()->associate($post);
    //     $comment->user()->associate(auth()->user());

    //     $comment->body=$request->body;
        
    //     $comment->save();

    //     return back();

    // }

    public function destroy($id)
    {
        $user = User::destroy($id);

        $response = [
            'user' => $user,
            'message' => 'user is deleted'
        ];
        
        return response($response, 201);
    }
}