<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\ApplicantCity;

class ApplicantCityTableSeeder extends Seeder {

    public function run() {
        
        ApplicantCity::create(array(
            'applicant_id' => 1,
            'city_id' => 7
        ));
        
        ApplicantCity::create(array(
            'applicant_id' => 2,
            'city_id' => 3
        ));
    }

}
