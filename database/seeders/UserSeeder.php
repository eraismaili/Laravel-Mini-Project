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
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //krijimi i permissions
        //  $manageCompaniesPermission = Permission::create(['name' => 'manage companies']);

        //$adminRole->givePermissionTo($manageCompaniesPermission);


        $user = User::create([
            'name' => 'Era Ismaili',
            'email' => 'era@gmail.com',
            'password' => Hash::make('password'),
        ]);
        //$user->assignRole($adminRole);
    }
}
