<?php

use Illuminate\Database\Seeder;
use App\Models\Job\Jobtype;

class JobtypeTableSeeder extends Seeder {

    public function run() {
        
        Jobtype::create(array(
            'name' => "Festanstellung"
        ));
        
        Jobtype::create(array(
            'name' => "Freelancer"
        ));
        
        Jobtype::create(array(
            'name' => "Remote"
        ));
    }

}
