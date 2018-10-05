<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\Position;

class PositionTableSeeder extends Seeder {

    public function run() {
        
        Position::create(array(
            'name' => "Solution Consultants"
        ));
        
        Position::create(array(
            'name' => "Solution Engineers"
        ));
        
        Position::create(array(
            'name' => "Technical Support Engineers"
        ));
        
        Position::create(array(
            'name' => "Developer"
        ));
    }

}
