<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicantExperienceTable extends Migration {

	public function up()
	{
		Schema::create('applicant_experience', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('applicant_id')->unsigned();
			$table->integer('experience_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('applicant_experience');
	}
}