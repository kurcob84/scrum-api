<?php

use Illuminate\Database\Seeder;
use App\Models\Job\CityJob;

class CityJobTableSeeder extends Seeder {

    public function run() {
        
        CityJob::create(array(
            'job_id' => 1,
            'city_id' => 1
        ));
        
        CityJob::create(array(
            'job_id' => 1,
            'city_id' => 2
        ));
        
        CityJob::create(array(
            'job_id' => 2,
            'city_id' => 3
        ));
        
        CityJob::create(array(
            'job_id' => 2,
            'city_id' => 4
        ));
    }

}
