<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullanswetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fullanswets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('answer');
            $table->integer('course_id')->unsigned();
            $table->integer('question_id')->unsigned();
      
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
        Schema::dropIfExists('fullanswets');
    }
}
