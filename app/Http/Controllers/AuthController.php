<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function RegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {

        $user = new User();
        //e  thirr funksionin validated para se me i perdor requestat 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $role = $request->role;
        $user->assignRole($role);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    public function LoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //perdor form request 
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('profile.show');
        } else {
            return redirect()->back()->withErrors(['login_error' => 'Invalid email or password.']);
        }
    }
}