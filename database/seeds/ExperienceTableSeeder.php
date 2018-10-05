<?php

use Illuminate\Database\Seeder;
use App\Models\Misc\Experience;

class ExperienceTableSeeder extends Seeder {

    public function run() {
        
        Experience::create(array(
            'applicant_id' => 1,
            'company' => "Audi",
            'city' => "Dresden",
            'from' => "2015-02-01 21:00:55",
            'to' => "2018-02-01 21:00:55",
            'position' => "Teamleiter",
            'tasks' => "Zu viele"
        ));
        
        Experience::create(array(
            'applicant_id' => 2,
            'company' => "Vufo",
            'city' => "Dresden",
            'from' => "2012-02-01 21:00:55",
            'to' => "2013-02-01 21:00:55",
            'position' => "Architekt",
            'tasks' => "Zu wenige"
        ));
    }

}
