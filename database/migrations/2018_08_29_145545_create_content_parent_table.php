<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentParentTable extends Migration {

	public function up()
	{
		Schema::create('content_parent', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 250);
		});
	}

	public function down()
	{
		Schema::drop('content_parent');
	}
}