<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'username' => 'required',
        ]);

        return User::create($request->all());
        
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function search($name)
    {
        return User::where('name', 'like', '%'.$name.'%')->get();
    }
}
