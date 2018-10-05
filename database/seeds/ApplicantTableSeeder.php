<?php

use Illuminate\Database\Seeder;
use App\Models\Applicant\Applicant;

class ApplicantTableSeeder extends Seeder {

    public function run() {
        
        Applicant::create(array(
            'email' => "applicant1@applicant1.de",
            'password' => Hash::make('test'),
            'firstname' => "Applicant1",
            'lastname' => "Mustermann",
            'birthday' => "1984-02-01 21:00:55",
            'city' => "Dresden",
            'description' => "Ich bin nett",
            'telephone' => "017612345678",
            'github' => "https://github.com/kurcob84",
            'skype' => "skype.com",
            'salary' => "2000",
            'periodofnotice' => "Test",
            'linkedin' => "linkedin.de",
            'xing' => "xing.de/musterman",
            'role_id' => 2,
            'picture_id' => 1
        ));
        
        Applicant::create(array(
            'email' => "applicant2@applicant2.de",
            'password' => Hash::make('test'),
            'firstname' => "Test",
            'lastname' => "Tester",
            'birthday' => "1980-02-01 21:00:55",
            'city' => "Berlin",
            'description' => "Ich will arbeiten",
            'telephone' => "384/r543r43",
            'skype' => "skype.de/tester",
            'salary' => "1000",
            'periodofnotice' => "fdafds",
            'github' => "github.de/tester",
            'linkedin' => "linkedin.de/tester",
            'xing' => "xing.de/tester",
            'role_id' => 2,
            'picture_id' => 2
        ));
    }

}
