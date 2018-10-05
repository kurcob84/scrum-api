<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApplicationJobTable extends Migration {

	public function up()
	{
		Schema::create('application_job', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->timestamp('sendet_at')->nullable();
			$table->timestamp('accepted_at')->nullable();
			$table->timestamp('rejected_admin_at')->nullable();
			$table->timestamp('rejected_company_at')->nullable();
			$table->timestamp('expired_at')->nullable();
			$table->timestamp('retired_at')->nullable();
			$table->timestamp('finished_after_application_at')->nullable();
			$table->integer('job_id')->unsigned();
			$table->integer('applicant_id')->unsigned();
			$table->integer('admin_id')->unsigned();
			$table->string('application', 500);
			$table->string('rejected_admin_reason', 250)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('application_job');
	}
}