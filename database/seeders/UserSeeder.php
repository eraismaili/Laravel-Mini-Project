<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{ 
    $permissions = [
            'view-company'
        ];
    public function run()
    {
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

       


        $user = User::create([
            'name' => 'Era Ismaili',
            'email' => 'era@gmail.com',
            'password' => Hash::make('password'),
        ]);
        //$user->assignRole($adminRole);
    }
}
