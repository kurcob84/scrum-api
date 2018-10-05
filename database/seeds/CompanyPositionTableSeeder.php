<?php

use Illuminate\Database\Seeder;
use App\Models\Company\CompanyPosition;

class CompanyPositionTableSeeder extends Seeder {

    public function run() {
        
        CompanyPosition::create(array(
            'company_id' => 1,
            'position_id' => 1
        ));
        CompanyPosition::create(array(
            'company_id' => 1,
            'position_id' => 2
        ));
        CompanyPosition::create(array(
            'company_id' => 2,
            'position_id' => 3
        ));
        CompanyPosition::create(array(
            'company_id' => 2,
            'position_id' => 4
        ));
    }

}
