<?php

use Illuminate\Database\Seeder;
use App\Models\Job\ApplicationJob;

class ApplicationJobTableSeeder extends Seeder {

    public function run() {
        
        ApplicationJob::create(array(
            'job_id' => 1,
            'applicant_id' => 1,
            'admin_id' => 1,
            'application' => "Bewerbung 1"
        ));
        
        ApplicationJob::create(array(
            'job_id' => 2,
            'applicant_id' => 2,
            'admin_id' => 1,
            'application' => "Bewerbung 2"
        ));
    }

}
