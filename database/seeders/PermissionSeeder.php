<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'view-users',
        'create-users',
        'edit-users',
        'delete-users',
        'view-companies',
        'create-companies',
        'edit-companies',
        'delete-companies'
    ];


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // foreach ($this->permissions as $permission) {
        //Permission::create(['name' => $permission]);
        // }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'Gresa Salihu',
            'email' => 'gresa@gmail.com',
            'password' => Hash::make('password')
        ]);

        $role = Role::where('name', 'Admin')->first();

        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}