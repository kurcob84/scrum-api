<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\ApplicantJobtype;

class ApplicantJobtypeTableSeeder extends Seeder {

    public function run() {
        
        ApplicantJobtype::create(array(
            'applicant_id' => 1,
            'jobtype_id' => 1
        ));
        
        ApplicantJobtype::create(array(
            'applicant_id' => 1,
            'jobtype_id' => 2
        ));
        
        ApplicantJobtype::create(array(
            'applicant_id' => 2,
            'jobtype_id' => 3
        ));
        
        ApplicantJobtype::create(array(
            'applicant_id' => 2,
            'jobtype_id' => 3
        ));
    }

}
