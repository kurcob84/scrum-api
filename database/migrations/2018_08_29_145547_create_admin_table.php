<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminTable extends Migration {

	public function up()
	{
		Schema::create('admin', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('email', 150)->unique();
			$table->string('password', 250);
			$table->integer('salutation')->nullable();
			$table->string('firstname', 250);
			$table->string('lastname', 250);
			$table->integer('role_id')->unsigned();
			$table->rememberToken('rememberToken');
		});
	}

	public function down()
	{
		Schema::drop('admin');
	}
}