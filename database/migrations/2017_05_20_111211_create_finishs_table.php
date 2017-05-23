<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinishsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Finishs', function (Blueprint $table) {
          $table->increments('id');
          $table->string('course_id');
          $table->string('user_id');
          $table->string('quiz_id');
          $table->unique(['user_id', 'quiz_id']);
          $table->string('score');
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
        Schema::dropIfExists('Finishs');
    }
}
