<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  public function movies() {
    return $this->belongsToMany('App\Movie', 'genders_movies',
      'gender_id' , 'movie_id');
  }
}
