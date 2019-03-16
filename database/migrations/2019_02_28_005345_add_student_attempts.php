<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentAttempts extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attempts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('calculated_grade');
            $table->datetime('attempt_date');
            $table->integer('quiz_id')->unsigned();
            $table->foreign('quiz_id')->references('id')->on('quizzes');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_attempts', function($table) {
            $table->dropForeign('student_attempts_quiz_id_foreign');
            $table->dropForeign('student_attempts_student_id_foreign');
        });

        Schema::dropIfExists('student_attempts');
    }
}


