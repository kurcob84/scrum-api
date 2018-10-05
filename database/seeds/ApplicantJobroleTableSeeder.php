<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\ApplicantJobrole;

class ApplicantJobroleTableSeeder extends Seeder {

    public function run() {
        
        ApplicantJobrole::create(array(
            'applicant_id' => 1,
            'jobrole_id' => 1
        ));
        
        ApplicantJobrole::create(array(
            'applicant_id' => 1,
            'jobrole_id' => 6
        ));
        
        ApplicantJobrole::create(array(
            'applicant_id' => 2,
            'jobrole_id' => 2
        ));
        
        ApplicantJobrole::create(array(
            'applicant_id' => 2,
            'jobrole_id' => 4
        ));
    }

}
