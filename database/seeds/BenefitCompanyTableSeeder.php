<?php

use Illuminate\Database\Seeder;
use App\Models\Company\BenefitCompany;

class BenefitCompanyTableSeeder extends Seeder {

    public function run() {

        BenefitCompany::create(array(
            'company_id' => 1,
            'benefit_id' => 1
        ));

        BenefitCompany::create(array(
            'company_id' => 1,
            'benefit_id' => 2
        ));

        BenefitCompany::create(array(
            'company_id' => 2,
            'benefit_id' => 3
        ));
        
        BenefitCompany::create(array(
            'company_id' => 2,
            'benefit_id' => 4
        ));
    }

}
