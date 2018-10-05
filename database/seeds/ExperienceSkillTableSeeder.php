<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\ExperienceSkill;

class ExperienceSkillTableSeeder extends Seeder {

    public function run() {
        
        ExperienceSkill::create(array(
            'experience_id' => 1,
            'skill_id' => 4
        ));
        
        ExperienceSkill::create(array(
            'experience_id' => 1,
            'skill_id' => 2
        ));
        
        ExperienceSkill::create(array(
            'experience_id' => 2,
            'skill_id' => 3
        ));
        
        ExperienceSkill::create(array(
            'experience_id' => 2,
            'skill_id' => 5
        ));
    }

}
