<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\ApplicantSkillOther;

class ApplicantSkillOtherTableSeeder extends Seeder {

    public function run() {
        
        ApplicantSkillOther::create(array(
            'applicant_id' => 1,
            'skill_id' => 1
        ));
        
        ApplicantSkillOther::create(array(
            'applicant_id' => 1,
            'skill_id' => 2
        ));
        
        ApplicantSkillOther::create(array(
            'applicant_id' => 1,
            'skill_id' => 5
        ));
        
        ApplicantSkillOther::create(array(
            'applicant_id' => 2,
            'skill_id' => 4
        ));
        
        ApplicantSkillOther::create(array(
            'applicant_id' => 2,
            'skill_id' => 1
        ));
    }

}
