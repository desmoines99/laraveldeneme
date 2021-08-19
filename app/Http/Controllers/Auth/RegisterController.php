<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }    

    public function index(){
        return view('auth.register');
    }
    public function store(Request $request){

        
        $fields = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name'=> $fields['name'],
            'username'=> $fields['username'],
            'email'=> $fields['email'],
            'password'=> bcrypt($fields['password']),
        ]);

        // $token = $user->createToken('myapptoken')->plainTextToken;

        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];
        return redirect()->route('dashboard');

        // return response($response,201);
        
    }

    
}
