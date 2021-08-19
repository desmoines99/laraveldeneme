<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index()
    {

        return view('auth.login');
    }

    public function store(Request $request)
    {  
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        return redirect()->route('home');

        // $token = $user->createToken('myapptoken')->plainTextToken;        
        
        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];
        
        // return response($response,201);


        // if (!auth()->attempt($request->only('email', 'password'), $request->remember)){
        //     return back()->with('status', 'Invalid login details');
        // }
        // return redirect()->route('dashboard');
    }
}
