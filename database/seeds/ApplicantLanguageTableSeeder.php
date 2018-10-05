<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\ApplicantLanguage;

class ApplicantLanguageTableSeeder extends Seeder {

    public function run() {
        
        ApplicantLanguage::create(array(
            'applicant_id' => 1,
            'language_id' => 1,
            'language_skill_id' => 1
        ));
        
        ApplicantLanguage::create(array(
            'applicant_id' => 1,
            'language_id' => 2,
            'language_skill_id' => 2
        ));
        
        ApplicantLanguage::create(array(
            'applicant_id' => 2,
            'language_id' => 3,
            'language_skill_id' => 3
        ));
        
        ApplicantLanguage::create(array(
            'applicant_id' => 2,
            'language_id' => 1,
            'language_skill_id' => 3
        ));
    }

}
