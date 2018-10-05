<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicantTable extends Migration {

	public function up()
	{
		Schema::create('applicant', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->timestamp('confirmed_at')->nullable();
			$table->string('email', 150)->unique();
			$table->string('password', 250);
			$table->integer('salutation')->nullable();
			$table->string('firstname', 250);
			$table->string('lastname', 250);
			$table->timestamp('birthday')->nullable();
			$table->string('city', 250);
			$table->string('description', 250)->nullable();
			$table->string('telephone', 100)->nullable();
			$table->string('skype', 250)->nullable();
			$table->integer('salary')->nullable();
			$table->string('language', 2)->nullable();
			$table->integer('new_job')->default('0');
			$table->string('periodofnotice', 250)->nullable();
			$table->string('github', 250)->nullable();
			$table->string('linkedin', 250)->nullable();
			$table->string('xing', 250)->nullable();
			$table->integer('role_id')->unsigned();
			$table->integer('picture_id')->unsigned()->nullable();
			$table->rememberToken('rememberToken');
			$table->string('confirm_code', 250)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('applicant');
	}
}