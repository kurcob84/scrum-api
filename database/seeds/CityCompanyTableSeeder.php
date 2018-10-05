<?php

use Illuminate\Database\Seeder;
use App\Models\Company\CityCompany;

class CityCompanyTableSeeder extends Seeder {

    public function run() {
        
        CityCompany::create(array(
            'company_id' => 1,
            'city_id' => 1
        ));

        CityCompany::create(array(
            'company_id' => 1,
            'city_id' => 2
        ));

        CityCompany::create(array(
            'company_id' => 2,
            'city_id' => 3
        ));

        CityCompany::create(array(
            'company_id' => 2,
            'city_id' => 4
        ));
    }

}
