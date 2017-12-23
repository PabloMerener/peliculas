<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;
use App\Genre;
use App\People;
use App\JobRole;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;

class UploadFromSourceController extends Controller
{
    public function movies () {

      $file = file_get_contents("http://localhost/laravel/qpeliculas/public/cine.ar/json/movies_01.json");

      $json = json_decode($file);

      $j_movies = $json->prods;

      foreach ($j_movies as $j_movie) {

        $movie = new Movie;

        $movie->title       = $j_movie->tit;
        $movie->year        = $j_movie->an;
        $movie->movie_image = $j_movie->afi;
        $movie->synopsis    = $j_movie->sino;

        // https://img.cine.ar/image/563a45ac2916c53546d2bd59/context/odeon_afiche
        $url_afiche_prefix = "https://img.cine.ar/image/";
        $url_afiche_suffix = "/context/odeon_afiche";

        $url_image = $url_afiche_prefix . $j_movie->afi .$url_afiche_suffix;

        $contents = file_get_contents($url_image);
        Storage::put("posters/" . $j_movie->afi , $contents);

        $movie->save();

        $j_people = $j_movie->pers->{"01"};

        foreach ($j_people as $j_person) {

          $role = JobRole::where('name','=',$j_person->roldesc)->first();

          if (!$role) {
            $role = new JobRole;
            $role->name = $j_person->roldesc;
            $role->save();
          }

          $person = People::where('name','=',$j_person->nom)->first();

          if ($person) {

            $movie->people()->attach($person->id,["job_role_id"=>$role->id]);

          } else {
            $person = new People;

            $person->name      = $j_person->nom;
            $person->avatar    = $j_person->avatar;

            // https://img.cine.ar/image/563a46412916c53546d2be24/context/avatar
            $url_afiche_prefix = "https://img.cine.ar/image/";
            $url_afiche_suffix = "/context/avatar";

            $url_image = $url_afiche_prefix . $j_person->avatar .$url_afiche_suffix;

            $contents = file_get_contents($url_image);
            Storage::put("people/" . $person->avatar , $contents);

            $person->save();

            $movie->people()->attach($person->id,["job_role_id"=>$role->id]);
          }

        }

        $j_genres = $j_movie->gens;

        foreach ($j_genres as $j_genre) {

          $genre = Genre::where('name','=',$j_genre->nom)->first();

          if (!$genre) {
            $genre = new Genre;
            $genre->name = $j_genre->nom;
            $genre->save();
          }

          $movie->genres()->attach($genre->id);
        }

      }

    }

    public function genres () {

      $file = file_get_contents("http://localhost/laravel/qpeliculas/public/cine.ar/json/01_tipos_y_generos.json");

      $json = json_decode($file);

      // https://img.cine.ar/image/563a45ac2916c53546d2bd59/context/odeon_afiche
      $url_afiche_prefix = "https://img.cine.ar/image/";
      $url_afiche_suffix = "/context/odeon_afiche";

      $j_genres = $json->generos;

      foreach ($j_genres as $j_genre) {

        $genre = new Genre;

        $genre->title = $j_genre->nom;

        $genre->save();
      }

    }

    public function people () {

      $file = file_get_contents("http://localhost/laravel/qpeliculas/public/cine.ar/json/movies_01.json");

      $json = json_decode($file);

      // https://img.cine.ar/image/563a46412916c53546d2be24/context/avatar
      $url_afiche_prefix = "https://img.cine.ar/image/";
      $url_afiche_suffix = "/context/avatar";

      $objects = $json->prods;

      foreach ($objects as $object) {

        $people = $object->pers->{"01"};

        foreach ($people as $person) {

          $model = new People;

          $model->name      = $person->nom;
          $model->role      = $person->rol;
          $model->role_desc = $person->roldesc;
          $model->avatar    = $person->avatar;

          $url_image = $url_afiche_prefix . $person->avatar .$url_afiche_suffix;

          $contents = file_get_contents($url_image);

          Storage::put("people/" . $person->avatar , $contents);

          $model->save();
        }
      }
    }

}
