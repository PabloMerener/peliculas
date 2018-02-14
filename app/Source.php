<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
  public function movies() {
    return $this->belongsToMany('App\Movie', 'movies_sources',
      'source_id' , 'movie_id');
  }
}
