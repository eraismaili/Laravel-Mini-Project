<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        //admin User
        $adminUser = User::create([
            'name' => 'Erjon',
            'email' => 'erjon@gmail.com',
            'password' => Hash::make('erjon123'),

        ]);
        $adminUser->assignRole('admin');
        //regular user
        User::create([
            'name' => 'Era',
            'email' => 'eraa@gmail.com',
            'password' => Hash::make('era123'),
        ]);
    }
}
