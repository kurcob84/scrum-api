<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\Role;

class RoleTableSeeder extends Seeder {

    public function run() {
        
        Role::create(array(
            'name' => "ADMIN"
        ));
        
        Role::create(array(
            'name' => "APPLICANT"
        ));
        
        Role::create(array(
            'name' => "COMPANY"
        ));
    }

}