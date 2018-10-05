<?php

use Illuminate\Database\Seeder;
use App\Models\Job\JobSkill;

class JobSkillTableSeeder extends Seeder {

    public function run() {
        
        JobSkill::create(array(
            'job_id' => 1,
            'skill_id' => 1
        ));
        
        JobSkill::create(array(
            'job_id' => 1,
            'skill_id' => 2
        ));
        
        JobSkill::create(array(
            'job_id' => 2,
            'skill_id' => 3
        ));
        
        JobSkill::create(array(
            'job_id' => 2,
            'skill_id' => 1
        ));
    }

}
