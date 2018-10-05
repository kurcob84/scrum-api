<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExperienceSkillTable extends Migration {

	public function up()
	{
		Schema::create('experience_skill', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('experience_id')->unsigned();
			$table->integer('skill_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('experience_skill');
	}
}