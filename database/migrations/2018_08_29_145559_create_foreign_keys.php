<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('applicant', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('role')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant', function(Blueprint $table) {
			$table->foreign('picture_id')->references('id')->on('media')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_skill_other', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_skill_other', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skill')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_skill_top', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_skill_top', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skill')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('experience_skill', function(Blueprint $table) {
			$table->foreign('experience_id')->references('id')->on('experience')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('experience_skill', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skill')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('education', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('experience', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		
		Schema::table('applicant_jobrole', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_jobrole', function(Blueprint $table) {
			$table->foreign('jobrole_id')->references('id')->on('jobrole')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_jobtype', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_jobtype', function(Blueprint $table) {
			$table->foreign('jobtype_id')->references('id')->on('jobtype')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_city', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_city', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('city')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_language', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_language', function(Blueprint $table) {
			$table->foreign('language_id')->references('id')->on('language')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('applicant_language', function(Blueprint $table) {
			$table->foreign('language_skill_id')->references('id')->on('language_skill')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('media', function(Blueprint $table) {
			$table->foreign('conent_parent_id')->references('id')->on('content_parent')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('company', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('role')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('company', function(Blueprint $table) {
			$table->foreign('picture_id')->references('id')->on('media')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('benefit_company', function(Blueprint $table) {
			$table->foreign('company_id')->references('id')->on('company')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('benefit_company', function(Blueprint $table) {
			$table->foreign('benefit_id')->references('id')->on('benefit')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('company_position', function(Blueprint $table) {
			$table->foreign('company_id')->references('id')->on('company')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('company_position', function(Blueprint $table) {
			$table->foreign('position_id')->references('id')->on('position')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job', function(Blueprint $table) {
			$table->foreign('company_id')->references('id')->on('company')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job_skill', function(Blueprint $table) {
			$table->foreign('job_id')->references('id')->on('job')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job_skill', function(Blueprint $table) {
			$table->foreign('skill_id')->references('id')->on('skill')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job_jobtype', function(Blueprint $table) {
			$table->foreign('job_id')->references('id')->on('job')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job_jobtype', function(Blueprint $table) {
			$table->foreign('jobtype_id')->references('id')->on('job_jobtype')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('city_job', function(Blueprint $table) {
			$table->foreign('job_id')->references('id')->on('job')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('city_job', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('city')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('city_company', function(Blueprint $table) {
			$table->foreign('company_id')->references('id')->on('company')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('city_company', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('city')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job_language', function(Blueprint $table) {
			$table->foreign('job_id')->references('id')->on('job')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('job_language', function(Blueprint $table) {
			$table->foreign('language_id')->references('id')->on('language')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('application_job', function(Blueprint $table) {
			$table->foreign('job_id')->references('id')->on('job')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('application_job', function(Blueprint $table) {
			$table->foreign('applicant_id')->references('id')->on('applicant')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('application_job', function(Blueprint $table) {
			$table->foreign('admin_id')->references('id')->on('admin')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('admin', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('role')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('applicant', function(Blueprint $table) {
			$table->dropForeign('applicant_role_id_foreign');
		});
		Schema::table('applicant', function(Blueprint $table) {
			$table->dropForeign('applicant_picture_id_foreign');
		});
		Schema::table('applicant_skill_other', function(Blueprint $table) {
			$table->dropForeign('applicant_skill_other_applicant_id_foreign');
		});
		Schema::table('applicant_skill_other', function(Blueprint $table) {
			$table->dropForeign('applicant_skill_other_skill_id_foreign');
		});
		Schema::table('applicant_skill_top', function(Blueprint $table) {
			$table->dropForeign('applicant_skill_top_applicant_id_foreign');
		});
		Schema::table('applicant_skill_top', function(Blueprint $table) {
			$table->dropForeign('applicant_skill_top_skill_id_foreign');
		});
		Schema::table('experience_skill', function(Blueprint $table) {
			$table->dropForeign('experience_skill_experience_id_foreign');
		});
		Schema::table('experience_skill', function(Blueprint $table) {
			$table->dropForeign('experience_skill_skill_id_foreign');
		});
		Schema::table('education', function(Blueprint $table) {
			$table->dropForeign('education_applicant_id_foreign');
		});
		Schema::table('experience', function(Blueprint $table) {
			$table->dropForeign('experience_applicant_id_foreign');
		});
		Schema::table('applicant_jobrole', function(Blueprint $table) {
			$table->dropForeign('applicant_jobrole_applicant_id_foreign');
		});
		Schema::table('applicant_jobrole', function(Blueprint $table) {
			$table->dropForeign('applicant_jobrole_jobrole_id_foreign');
		});
		Schema::table('applicant_jobtype', function(Blueprint $table) {
			$table->dropForeign('applicant_jobtype_applicant_id_foreign');
		});
		Schema::table('applicant_jobtype', function(Blueprint $table) {
			$table->dropForeign('applicant_jobtype_jobtype_id_foreign');
		});
		Schema::table('applicant_city', function(Blueprint $table) {
			$table->dropForeign('applicant_city_applicant_id_foreign');
		});
		Schema::table('applicant_city', function(Blueprint $table) {
			$table->dropForeign('applicant_city_city_id_foreign');
		});
		Schema::table('applicant_language', function(Blueprint $table) {
			$table->dropForeign('applicant_language_applicant_id_foreign');
		});
		Schema::table('applicant_language', function(Blueprint $table) {
			$table->dropForeign('applicant_language_language_id_foreign');
		});
		Schema::table('applicant_language', function(Blueprint $table) {
			$table->dropForeign('applicant_language_language_skill_id_foreign');
		});
		Schema::table('media', function(Blueprint $table) {
			$table->dropForeign('media_conent_parent_id_foreign');
		});
		Schema::table('company', function(Blueprint $table) {
			$table->dropForeign('company_role_id_foreign');
		});
		Schema::table('company', function(Blueprint $table) {
			$table->dropForeign('company_picture_id_foreign');
		});
		Schema::table('benefit_company', function(Blueprint $table) {
			$table->dropForeign('benefit_company_company_id_foreign');
		});
		Schema::table('benefit_company', function(Blueprint $table) {
			$table->dropForeign('benefit_company_benefit_id_foreign');
		});
		Schema::table('company_position', function(Blueprint $table) {
			$table->dropForeign('company_position_company_id_foreign');
		});
		Schema::table('company_position', function(Blueprint $table) {
			$table->dropForeign('company_position_position_id_foreign');
		});
		Schema::table('job', function(Blueprint $table) {
			$table->dropForeign('job_company_id_foreign');
		});
		Schema::table('job_skill', function(Blueprint $table) {
			$table->dropForeign('job_skill_job_id_foreign');
		});
		Schema::table('job_skill', function(Blueprint $table) {
			$table->dropForeign('job_skill_skill_id_foreign');
		});
		Schema::table('job_jobtype', function(Blueprint $table) {
			$table->dropForeign('job_jobtype_job_id_foreign');
		});
		Schema::table('job_jobtype', function(Blueprint $table) {
			$table->dropForeign('job_jobtype_jobtype_id_foreign');
		});
		Schema::table('city_job', function(Blueprint $table) {
			$table->dropForeign('city_job_job_id_foreign');
		});
		Schema::table('city_job', function(Blueprint $table) {
			$table->dropForeign('city_job_city_id_foreign');
		});
		Schema::table('city_company', function(Blueprint $table) {
			$table->dropForeign('city_company_company_id_foreign');
		});
		Schema::table('city_company', function(Blueprint $table) {
			$table->dropForeign('city_company_city_id_foreign');
		});
		Schema::table('job_language', function(Blueprint $table) {
			$table->dropForeign('job_language_job_id_foreign');
		});
		Schema::table('job_language', function(Blueprint $table) {
			$table->dropForeign('job_language_language_id_foreign');
		});
		Schema::table('application_job', function(Blueprint $table) {
			$table->dropForeign('application_job_job_id_foreign');
		});
		Schema::table('application_job', function(Blueprint $table) {
			$table->dropForeign('application_job_applicant_id_foreign');
		});
		Schema::table('application_job', function(Blueprint $table) {
			$table->dropForeign('application_job_admin_id_foreign');
		});
		Schema::table('admin', function(Blueprint $table) {
			$table->dropForeign('admin_role_id_foreign');
		});
	}
}