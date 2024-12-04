<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function home()
    {
        return view('example.home', ['message' => 'This is Home Page!']);
    }

    public function create()
    {
        return view('user.create');  
    }

    public function index()
    {
        $users = User::all();  
        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), 
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully!');
    }
}
