<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\ContentParent;

class ContentParentTableSeeder extends Seeder {

    public function run() {
        
        ContentParent::create(array(
            'name' => "APPLICANT"
        ));
        
        ContentParent::create(array(
            'name' => "COMPANY"
        ));
    }

}
