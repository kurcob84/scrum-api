<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\LanguageSkill;

class LanguageSkillTableSeeder extends Seeder {

    public function run() {
        
        LanguageSkill::create(array(
            'name' => "Keine Kenntnisse"
        ));
        
        LanguageSkill::create(array(
            'name' => "Grundkenntnisse"
        ));
        
        LanguageSkill::create(array(
            'name' => "Fortgeschritten"
        ));
        
        LanguageSkill::create(array(
            'name' => "Verhandlungssicher"
        ));
        
        LanguageSkill::create(array(
            'name' => "Muttersprachlich"
        ));
    }

}
