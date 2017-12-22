<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMoviesPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('movies_people', function (Blueprint $table) {
        $table->integer('movie_id')->unsigned();
        $table->foreign('movie_id')->references('id')->on('movies');
        $table->integer('person_id')->unsigned();
        $table->foreign('person_id')->references('id')->on('people');
        $table->primary(['movie_id', 'person_id']);
        $table->timestamps();
        $table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies_people');
    }
}
