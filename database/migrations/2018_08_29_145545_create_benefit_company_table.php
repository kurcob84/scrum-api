<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBenefitCompanyTable extends Migration {

	public function up()
	{
		Schema::create('benefit_company', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('company_id')->unsigned();
			$table->integer('benefit_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('benefit_company');
	}
}