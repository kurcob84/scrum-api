<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\User_Role;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'ADMIN')->first();
        $role_user = Role::where('name', 'USER')->first();

        $user = new User();
        $user->firstname        = "Admin";
        $user->surname          = "Rogge";
        $user->salutation       = 1;
        $user->email            = "roggepatrick@googlemail.com";
        $user->language         = 'de';
        $user->password         = Hash::make('scrum');
        $user->save();

        $user_role = new User_Role();
        $user_role->user_id     = $user->id;
        $user_role->role_id     = $role_admin->id;
        $user_role->save();

        $user = new User();
        $user->firstname        = "User";
        $user->surname          = "Patrick";
        $user->salutation       = 2;
        $user->email            = "roggepatrick@gmail.com";
        $user->language         = 'en';
        $user->password         = Hash::make('scrum');
        $user->save();

        $user_role = new User_Role();
        $user_role->user_id     = $user->id;
        $user_role->role_id     = $role_user->id;
        $user_role->save();
    }
}