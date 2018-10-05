<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicantSkillOtherTable extends Migration {

	public function up()
	{
		Schema::create('applicant_skill_other', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('applicant_id')->unsigned();
			$table->integer('skill_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('applicant_skill_other');
	}
}