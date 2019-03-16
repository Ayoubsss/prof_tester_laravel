<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quizzes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 45);
            $table->string('description', 50);
            $table->integer('weight');
            $table->longText('answerKey');
            $table->boolean('status')->default(1);
            $table->boolean('isGroupQuiz')->default(0);
            $table->datetime('startDate');
            $table->datetime('endDate');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
