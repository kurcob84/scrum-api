<?php

use Illuminate\Database\Seeder;
use App\Models\Company\Company;

class CompanyTableSeeder extends Seeder {

    public function run() {
        
        Company::create(array(
            'email' => "audi@audi.de",
            'password' =>  Hash::make('test'),
            'name' => "Audi",
            'about_us' => "Wir sind ein aufstrebens Unternehmen",
            'founding' => 1956,
            'size' => "200",
            'xing' => "https://www.xing.com/companies/audi",
            'website' => "www.audi.de",
            'linkedin' => "https://de.linkedin.com/company/audi",
            'youtube' => "https://www.youtube.com/channel/UC-kt4i2ymMbOsNSoN5HgI_Q",
            'twitter' => "https://twitter.com/audi?lang=de",
            'telephone' => "035112345678",
            'role_id' => 3,
            'picture_id' => 3
        ));

        Company::create(array(
            'email' => "telekom@telekom.de",
            'password' => Hash::make('test'),
            'name' => "Telekom",
            'about_us' => "Wir sind die größten",
            'founding' => 1970,
            'size' => "2000",
            'xing' => "xing.de/telekom",
            'website' => "telekom.de",
            'linkedin' => "linkedin.de/telekom",
            'youtube' => "youtube.com/telekom",
            'twitter' => "twitter.com/telekom",
            'telephone' => "044/423543543",
            'role_id' => 3,
            'picture_id' => 4
        ));
    }

}
