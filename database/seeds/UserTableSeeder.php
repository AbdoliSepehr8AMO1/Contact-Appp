<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $user = new User;
        $user->name = 'sepehr user';
        $user->email = 'sepehruser@outlook.com';
        $user->password = bcrypt('test123');
        $user->save();
        $user->roles()->attach(Role::where('name', 'user')->first());

        $admin = new User;
        $admin->name = 'sepehr admin';
        $admin->email = 'sepehradmin@outlook.com';
        $admin->password = bcrypt('test123');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'admin')->first());
    }
}

