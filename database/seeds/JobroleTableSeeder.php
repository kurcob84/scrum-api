<?php

use Illuminate\Database\Seeder;
use App\Models\Job\Jobrole;

class JobroleTableSeeder extends Seeder {

    public function run() {
        
        Jobrole::create(array(
            'name' => "Software Entwickler"
        ));
        
        Jobrole::create(array(
            'name' => "Fullstack Entwickler"
        ));
        
        Jobrole::create(array(
            'name' => "Backend Entwickler"
        ));
        
        Jobrole::create(array(
            'name' => "Frontend Entwickler"
        ));
        
        Jobrole::create(array(
            'name' => "Mobile Entwickler"
        ));
        
        Jobrole::create(array(
            'name' => "IT Architekt"
        ));
        
        Jobrole::create(array(
            'name' => "Data Scientist"
        ));
        
        Jobrole::create(array(
            'name' => "Systemadministration"
        ));
        
        Jobrole::create(array(
            'name' => "DevOps"
        ));
        
        Jobrole::create(array(
            'name' => "Qualitätssicherung"
        ));
        
        Jobrole::create(array(
            'name' => "Teamleiter"
        ));
        
        Jobrole::create(array(
            'name' => "Projektmanager"
        ));
        
        Jobrole::create(array(
            'name' => "Produktmanager"
        ));
        
        Jobrole::create(array(
            'name' => "Scrum Master"
        ));
        
        Jobrole::create(array(
            'name' => "Technical Consultant"
        ));
        
        Jobrole::create(array(
            'name' => "SAP Berater"
        ));
        
        Jobrole::create(array(
            'name' => "UX/UI Designer"
        ));
        
        Jobrole::create(array(
            'name' => "Business Intelligence"
        ));
        
        Jobrole::create(array(
            'name' => "CTO/CIO (Entwicklungsleiter)"
        ));
    }

}
