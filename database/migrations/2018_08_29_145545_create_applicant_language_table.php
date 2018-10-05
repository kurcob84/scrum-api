<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicantLanguageTable extends Migration {

	public function up()
	{
		Schema::create('applicant_language', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('applicant_id')->unsigned();
			$table->integer('language_id')->unsigned();
			$table->integer('language_skill_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('applicant_language');
	}
}