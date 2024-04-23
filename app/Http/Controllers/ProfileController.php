<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('auth.edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = User::findOrFail(auth()->id());

        $validatedData = $request->validated();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(UserRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
    public function showUpdatePasswordForm()
    {
        return view('auth.updatepassword');
    }
}
