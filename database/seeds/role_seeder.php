<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class role_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "ADMIN";
        $role->save();

        $role = new Role();
        $role->name = "USER";
        $role->save();
    }
}