<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobJobtypeTable extends Migration {

	public function up()
	{
		Schema::create('job_jobtype', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('job_id')->unsigned();
			$table->integer('jobtype_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('job_jobtype');
	}
}