<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobtypeTable extends Migration {

	public function up()
	{
		Schema::create('jobtype', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 250);
		});
	}

	public function down()
	{
		Schema::drop('jobtype');
	}
}