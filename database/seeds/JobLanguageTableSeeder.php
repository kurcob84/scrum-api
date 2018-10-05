<?php

use Illuminate\Database\Seeder;
use App\Models\Job\JobLanguage;

class JobLanguageTableSeeder extends Seeder {

    public function run() {
        
        JobLanguage::create(array(
            'job_id' => 1,
            'language_id' => 1
        ));
        
        JobLanguage::create(array(
            'job_id' => 1,
            'language_id' => 2
        ));
        
        JobLanguage::create(array(
            'job_id' => 2,
            'language_id' => 3
        ));
        
        JobLanguage::create(array(
            'job_id' => 2,
            'language_id' => 1
        ));
    }

}
