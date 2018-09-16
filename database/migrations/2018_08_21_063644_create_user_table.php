<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('confirmed_at')->nullable();
            $table->string('firstname', 250)->nullable();
            $table->string('surname', 250)->nullable();
            $table->string('language', 2)->nullable();
            $table->integer('salutation')->nullable();
            $table->string('email', 250)->unique();
            $table->string('password', 250)->nullable();
            $table->string('confirm_code', 250)->nullable();
            $table->string('facebook_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
