<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;

use App\Gender;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;

class UploadFromSourceController extends Controller
{
    public function movies () {

      $file = file_get_contents("http://localhost/laravel/qpeliculas/public/cine.ar/json/movies_01.json");

      $json = json_decode($file);

      // https://img.cine.ar/image/563a45ac2916c53546d2bd59/context/odeon_afiche
      $url_afiche_prefix = "https://img.cine.ar/image/";
      $url_afiche_suffix = "/context/odeon_afiche";

      $j_movies = $json->prods;

      foreach ($j_movies as $j_movie) {

        $movie = new Movie;

        $movie->title       = $j_movie->tit;
        $movie->year        = $j_movie->an;
        $movie->movie_image = $j_movie->afi;

        $url_image = $url_afiche_prefix . $j_movie->afi .$url_afiche_suffix;

        $contents = file_get_contents($url_image);

        Storage::put("posters/" . $j_movie->afi , $contents);

        $movie->save();
      }

    }

    public function genders () {

      $file = file_get_contents("http://localhost/laravel/qpeliculas/public/cine.ar/json/01_tipos_y_generos.json");

      $json = json_decode($file);

      // https://img.cine.ar/image/563a45ac2916c53546d2bd59/context/odeon_afiche
      $url_afiche_prefix = "https://img.cine.ar/image/";
      $url_afiche_suffix = "/context/odeon_afiche";

      $j_genders = $json->generos;

      foreach ($j_genders as $j_gender) {

        $gender = new Gender;

        $gender->title = $j_gender->nom;

        $gender->save();
      }

    }
}