<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompanyPositionTable extends Migration {

	public function up()
	{
		Schema::create('company_position', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('company_id')->unsigned();
			$table->integer('position_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('company_position');
	}
}