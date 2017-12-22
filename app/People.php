<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
  public function movies() {
    return $this->belongsToMany('App\Movie', 'movies_people',
      'person_id' , 'movie_id');
  }
}
