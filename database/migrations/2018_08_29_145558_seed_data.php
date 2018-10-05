<?php

use Illuminate\Database\Migrations\Migration;

class SeedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Artisan::call('db:seed', ['--class' => ApplicantTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => SkillTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantSkillOtherTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantSkillTopTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ExperienceTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ExperienceSkillTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => EducationTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => JobroleTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantJobroleTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => JobtypeTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantJobtypeTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => CityTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantCityTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => LanguageTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => LanguageSkillTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantLanguageTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => MediaTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ContentParentTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => CompanyTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => BenefitTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => BenefitCompanyTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => PositionTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => CompanyPositionTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => JobTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => JobSkillTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => JobJobtypeTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => CityJobTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => CityCompanyTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => JobLanguageTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => AdminTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => RoleTableSeeder::class]);  
        Artisan::call('db:seed', ['--class' => ApplicationJobTableSeeder::class]);
        Artisan::call('db:seed', ['--class' => ApplicantExperienceTableSeeder::class]);  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // only seeders used for up - no down possible
    }
}
