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
        $table->integer('job_role_id')->unsigned();
        $table->foreign('job_role_id')->references('id')->on('jobs_roles');
        $table->primary(['movie_id', 'person_id','job_role_id']);
        $table->timestamps();
        $table->softDeletes();
        $table->smallInteger('order')->default(0);
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
