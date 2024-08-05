<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function show()
    {
        $user = $this->profileService->getUser();
        return view('auth.profile', compact('user'));
    }

    public function edit()
    {
        $user = $this->profileService->getUser();
        return view('auth.edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $this->profileService->updateUser($request->validated());

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $updated = $this->profileService->updatePassword($request->validated());

        if (!$updated) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function showUpdatePasswordForm()
    {
        return view('auth.updatepassword');
    }
}
