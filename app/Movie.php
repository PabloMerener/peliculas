<?php

namespace App;

class Movie extends Model
{
   protected $table = 'movies';

  public function genres() {
    return $this->belongsToMany('App\Genre', 'genres_movies',
      'movie_id', 'genre_id');
  }

  // $movie->people()->attach(1,["job_role_id"=>2])
  public function people() {
    return $this->belongsToMany('App\People', 'movies_people',
      'movie_id', 'person_id')->withPivot('job_role_id');
  }

  public function jobsRoles() {
    return $this->belongsToMany('App\JobRole', 'movies_people',
      'movie_id', 'job_role_id');
  }

}
