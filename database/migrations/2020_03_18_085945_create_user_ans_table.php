<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
    
            $table->integer('lesson_id')->unsigned();
            
            $table->string('percent')->nullable();
            $table->string('result')->nullable();
            $table->integer('counterQ')->nullable();
            $table->integer('counterR')->nullable();
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
        Schema::dropIfExists('user_ans');
    }
}
