<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\Benefit;

class BenefitTableSeeder extends Seeder {

    public function run() {
        
        Benefit::create(array(
            'name' => "Free Beverages"
        ));
        
        Benefit::create(array(
            'name' => "Free Fruits"
        ));
        
        Benefit::create(array(
            'name' => "Health Insurance for colleagues in the UK"
        ));
        
        Benefit::create(array(
            'name' => "Home office acceptance"
        ));
        
        Benefit::create(array(
            'name' => "Sport and health services"
        ));
        
        Benefit::create(array(
            'name' => "individuelle Arbeitsplatzgestaltung"
        ));
    }

}
