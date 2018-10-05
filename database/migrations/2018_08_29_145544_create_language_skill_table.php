<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguageSkillTable extends Migration {

	public function up()
	{
		Schema::create('language_skill', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 250);
		});
	}

	public function down()
	{
		Schema::drop('language_skill');
	}
}