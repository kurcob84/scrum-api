<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyTable extends Migration {

	public function up()
	{
		Schema::create('company', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
            $table->timestamp('confirmed_at')->nullable();
			$table->string('email', 150)->unique();
			$table->string('password', 250)->nullable();
			$table->string('name', 250);
			$table->string('about_us', 500)->nullable();
			$table->integer('founding')->nullable();
			$table->string('size', 250)->nullable();
			$table->string('xing', 250)->nullable();
			$table->string('website', 250)->nullable();
			$table->string('linkedin', 250)->nullable();
			$table->string('youtube', 250)->nullable();
			$table->string('twitter', 250)->nullable();
			$table->string('telephone', 250)->nullable();
			$table->integer('role_id')->unsigned();
			$table->integer('picture_id')->unsigned()->nullable();
			$table->rememberToken('rememberToken');
            $table->string('confirm_code', 250)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('company');
	}
}