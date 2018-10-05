<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExperienceTable extends Migration {

	public function up()
	{
		Schema::create('experience', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('applicant_id')->unsigned();
			$table->string('company', 250);
			$table->string('city', 250);
			$table->timestamp('from')->nullable();
			$table->timestamp('to')->nullable();
			$table->string('position', 250);
			$table->string('tasks', 500);
		});
	}

	public function down()
	{
		Schema::drop('experience');
	}
}