<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show register form
    public function create()
    {
        return view('users.register');
    }

    //save new user
    public function store(Request $request)
    {
        //validate request data
        $formFields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed',
        ]);

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //create new user
        $user = User::create($formFields);

        //login
        auth()->login($user);

        //redirect to home page
        return redirect('/')->with('message', 'You are now logged in!');
    }

    //logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        @request()->session()->regenerateToken();

        return redirect('/')->with('message', 'You are now logged out!');
    }

    //show login form
    public function login()
    {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
