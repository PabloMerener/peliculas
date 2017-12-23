<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGenresMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('genres_movies', function (Blueprint $table) {
        $table->integer('genre_id')->unsigned();
        $table->foreign('genre_id')->references('id')->on('genres');
        $table->integer('movie_id')->unsigned();
        $table->foreign('movie_id')->references('id')->on('movies');
        $table->primary(['genre_id', 'movie_id']);
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
        Schema::dropIfExists('genres_movies');
    }
}
