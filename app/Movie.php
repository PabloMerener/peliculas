<?php

namespace App;

class Movie extends Model
{
   protected $table = 'movies';

  public function genders() {
    return $this->belongsToMany('App\Gender', 'genders_movies',
      'movie_id', 'gender_id');
  }

  public function people() {
    return $this->belongsToMany('App\People', 'movies_people',
      'movie_id', 'person_id');
  }

}
