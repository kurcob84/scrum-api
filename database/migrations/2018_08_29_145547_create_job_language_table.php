<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobLanguageTable extends Migration {

	public function up()
	{
		Schema::create('job_language', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('job_id')->unsigned();
			$table->integer('language_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('job_language');
	}
}