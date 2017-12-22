<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGendersMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('genders_movies', function (Blueprint $table) {
        $table->integer('gender_id')->unsigned();
        $table->foreign('gender_id')->references('id')->on('genders');
        $table->integer('movie_id')->unsigned();
        $table->foreign('movie_id')->references('id')->on('movies');
        $table->primary(['gender_id', 'movie_id']);
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
        Schema::dropIfExists('genders_movies');
    }
}
