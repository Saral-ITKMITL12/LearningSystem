<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('responses', function (Blueprint $table) {
          $table->increments('id');
          $table->string('user_id');
          $table->string('quiz_id');
          $table->string('question_id');
          $table->unique(['user_id', 'quiz_id', 'question_id']);
          $table->string('answer');
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
        Schema::dropIfExists('responses');
    }
}
