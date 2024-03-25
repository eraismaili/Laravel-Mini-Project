<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function RegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();


        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function LoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to profile page or other authenticated area
            return redirect()->intended('/profile');
        } else {
            // Authentication failed, redirect back with error message
            return redirect()->back()->withErrors(['login_error' => 'Invalid email or password.']);
        }
    }
}