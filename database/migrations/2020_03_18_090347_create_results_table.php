<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->unsigned();
     
            $table->integer('user_id')->unsigned();
         
            $table->string('result')->nullable();
            $table->string('user_name')->nullable();
            $table->string('slug')->nullable();
            
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
        Schema::dropIfExists('results');
    }
}
