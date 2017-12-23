<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
  public function movies() {
    return $this->belongsToMany('App\Movie', 'genres_movies',
      'genre_id' , 'movie_id');
  }
}
