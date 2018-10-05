<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillTable extends Migration {

	public function up()
	{
		Schema::create('skill', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 500);
		});
	}

	public function down()
	{
		Schema::drop('skill');
	}
}