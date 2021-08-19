<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LogoutController extends Controller
{
    public function store(Request $request)
    {
        auth()->logout();

        return redirect()->route('home');

    }
        
}
