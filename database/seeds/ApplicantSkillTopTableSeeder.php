<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\ApplicantSkillTop;

class ApplicantSkillTopTableSeeder extends Seeder {

    public function run() {
        
        ApplicantSkillTop::create(array(
            'applicant_id' => 1,
            'skill_id' => 3
        ));
        
        ApplicantSkillTop::create(array(
            'applicant_id' => 1,
            'skill_id' => 4
        ));
        
        ApplicantSkillTop::create(array(
            'applicant_id' => 2,
            'skill_id' => 3
        ));
        
        ApplicantSkillTop::create(array(
            'applicant_id' => 2,
            'skill_id' => 5
        ));
    }

}
