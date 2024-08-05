<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function getUser()
    {
        return Auth::user();
    }

    public function updateUser($data)
    {
        $user = User::findOrFail(Auth::id());

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return $user;
    }

    public function updatePassword($data)
    {
        $user = User::findOrFail(Auth::id());

        if (!Hash::check($data['current_password'], $user->password)) {
            return false;
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        return true;
    }
}
