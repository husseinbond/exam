<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('price')->nullable();
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->integer('selected')->nullable();
            $table->text('introduction')->nullable();
            $table->text('fq')->nullable();
            $table->text('whatis')->nullable();
            $table->text('whatuneed')->nullable();
            $table->string('slug')->nullable();
            $table->softdeletes();
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
        Schema::dropIfExists('courses');
    }
}
