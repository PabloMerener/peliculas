<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
  protected $table = 'jobs_roles';

  public function movies() {
    return $this->belongsToMany('App\Movie', 'movies_people',
      'job_role_id', 'movie_id');
  }
}
