<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration {

	public function up()
	{
		Schema::create('media', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('filename', 250);
			$table->string('path', 250);
			$table->integer('conent_parent_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('media');
	}
}