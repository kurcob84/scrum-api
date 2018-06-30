<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Answers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('answer')->default(0);
            $table->boolean('correct');
            $table->unsignedInteger('questions_id');
            $table->timestamps();

            $table->foreign('questions_id')
                    ->references('id')->on('questions')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('answers_questions_id_foreign');
        Schema::drop('answers');
    }
}
