<?php

use Illuminate\Database\Seeder;
use App\Models\Job\JobJobtype;

class JobJobtypeTableSeeder extends Seeder {

    public function run() {
        
        JobJobtype::create(array(
            'job_id' => 1,
            'jobtype_id' => 1
        ));
        
        JobJobtype::create(array(
            'job_id' => 1,
            'jobtype_id' => 2
        ));
        
        JobJobtype::create(array(
            'job_id' => 2,
            'jobtype_id' => 3
        ));
        
        JobJobtype::create(array(
            'job_id' => 2,
            'jobtype_id' => 2
        ));
    }

}
