<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEducationTable extends Migration {

	public function up()
	{
		Schema::create('education', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('applicant_id')->unsigned();
			$table->string('college', 250);
			$table->string('subject', 250);
			$table->string('degree', 250);
			$table->timestamp('from')->nullable();
			$table->timestamp('to')->nullable();
			$table->tinyInteger('active')->default('0');
			$table->string('description', 500);
		});
	}

	public function down()
	{
		Schema::drop('education');
	}
}