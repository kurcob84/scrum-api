<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\Language;

class LanguageTableSeeder extends Seeder {

    public function run() {
        
        Language::create(array(
            'name' => "Deutsch"
        ));
        
        Language::create(array(
            'name' => "Englisch"
        ));
        
        Language::create(array(
            'name' => "Spanisch"
        ));
        
        Language::create(array(
            'name' => "Französisch"
        ));
    }

}
