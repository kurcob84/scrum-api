<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;

class AdminTableSeeder extends Seeder {

    public function run() {
        
        Admin::create(array(
            'email' => "admin@admin.de",
            'password' => Hash::make('test'),
            'firstname' => "Admin",
            'lastname' => "Admin",
            'role_id' => 1
        ));
    }

}
