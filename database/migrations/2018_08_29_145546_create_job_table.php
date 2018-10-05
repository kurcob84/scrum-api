<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobTable extends Migration {

	public function up()
	{
		Schema::create('job', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('company_id')->unsigned();
			$table->string('title', 250);
			$table->string('description', 1000);
			$table->string('salary', 250);
		});
	}

	public function down()
	{
		Schema::drop('job');
	}
}