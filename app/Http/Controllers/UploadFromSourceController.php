<?php

namespace App\Http\Controllers;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;

use App\Movie;
use App\Genre;
use App\People;
use App\JobRole;
use App\Source;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\File;

class UploadFromSourceController extends Controller
{
  public function pelispedia () {

    return view ("movies.pelispedia");

    }




    // private function getCites (string $url) {
    private function getCites ($url) {

      try {
        $fp = file_get_contents($url);
      } catch (Exception $e) {
        // dd($e)
        return null;
      }

      // try {
      //     $content = file_get_contents('https://en.wikipedia.org/wiki/Cat#/media/File:Large_Siamese_cat_tosses_a_mouse.jpg');
      //
      //     if ($content === false) {
      //         // Handle the error
      //     }
      // } catch (Exception $e) {
      //     // Handle exception
      // }
      //
      if (!$fp) return null;

      // cites
      $cites = preg_match_all("/<cite>(.*)<\/cite>/siU", $fp, $title_matches);
      $cites = $title_matches[1];

      var_dump($cites);

      $res = preg_match_all('/<a(.*)<\/a>/siU', $fp, $title_matches);
      if (!$res) dd(null);

      $next = "";

      foreach ($title_matches as $key => $value) {

        foreach ($value as $k => $v) {
          if (strpos($v, 'href="/search?q=site:https://www.pelispedia.tv/pelicula/') !== false) {
            $next = $v;
          }

        }
      }

//    remove after href="
      if (!is_bool(strpos($next, 'href="')))
        $next = substr($next, strpos($next,'href="')+strlen('href="'));

      // remove before
      $next = substr($next, 0, strpos($next, '"'));
      // remove 'amp;'
      $host = parse_url($url, PHP_URL_HOST);
      $next = parse_url($url, PHP_URL_SCHEME) . "://" . $host . htmlspecialchars_decode($next);

      dd($next);

      // $this->getCites($next);
    }


    public function google (Request $request) {

      // $url = "https://www.pelispedia.tv/pelicula/constantine/";
      $url = "https://www.google.com.ar/search?hl=es-419&source=hp&ei=jd2EWqiIOsKGwQTtn7zgBQ&q=site%3Ahttps%3A%2F%2Fwww.pelispedia.tv%2Fpelicula%2F&oq=&gs_l=psy-ab.1.0.35i39k1l6.0.0.0.141204.5.1.0.0.0.0.0.0..1.0....0...1c..64.psy-ab..4.1.330.6...330.Uxo4iggclRs";

      // $ch = curl_init();
      //      $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
      //         curl_setopt($ch, CURLOPT_URL, $url);
      //         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
      //           curl_setopt($ch, CURLOPT_AUTOREFERER, false);
      //     curl_setopt($ch, CURLOPT_VERBOSE, 1);
      //     curl_setopt($ch, CURLOPT_HEADER, 0);
      //
      //         curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
      //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      //         curl_setopt($ch, CURLOPT_SSLVERSION,CURL_SSLVERSION_DEFAULT);
      //         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
      //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      //         $webcontent= curl_exec ($ch);
      //         $error = curl_error($ch);
      //         curl_close ($ch);
      //
      //         dd($webcontent, $ch);

$this->getCites($url);

//       $fp = file_get_contents($url);
//       if (!$fp) return null;
//
//       // cites
//       $cites = preg_match_all("/<cite>(.*)<\/cite>/siU", $fp, $title_matches);
//       $cites = $title_matches[1];
//
//       var_dump($cites);
//
//       $res = preg_match_all('/<a(.*)<\/a>/siU', $fp, $title_matches);
//       if (!$res) dd(null);
//
//       foreach ($title_matches as $key => $value) {
//
//         foreach ($value as $k => $v) {
//           if (strpos($v, 'href="/search?q=site:https://www.pelispedia.tv/pelicula/') !== false) {
//             $next = $v;
//           }
//
//         }
//       }
//
// //    remove after href="
//       if (!is_bool(strpos($next, 'href="')))
//         $next = substr($next, strpos($next,'href="')+strlen('href="'));
//
//       // remove before
//       $next = substr($next, 0, strpos($next, '"'));
//       // remove 'amp;'
//       $host = parse_url($url, PHP_URL_HOST);
//       $next = parse_url($url, PHP_URL_SCHEME) . "://" . $host . htmlspecialchars_decode($next);
//
//       var_dump($next);
//
//       $this->getCites($next);






      // $this->getCites($url);

//       //  = parse_url($url);
//       $host = parse_url($url, PHP_URL_HOST);
//
//       $fp = file_get_contents($url);
//       if (!$fp) return null;
//
//       // cites
//       $cites = preg_match_all("/<cite>(.*)<\/cite>/siU", $fp, $title_matches);
//       $cites = $title_matches[1];
//
//       $res = preg_match_all('/<a(.*)<\/a>/siU', $fp, $title_matches);
//       if (!$res) dd(null);
//
//       foreach ($title_matches as $key => $value) {
//
//         foreach ($value as $k => $v) {
//           if (strpos($v, 'href="/search?q=site:https://www.pelispedia.tv/pelicula/') !== false) {
//             $next = $v;
//           }
//
//         }
//       }
//
// //    remove after href="
//       if (!is_bool(strpos($next, 'href="')))
//         $next = substr($next, strpos($next,'href="')+strlen('href="'));
//
//       // remove before
//       $next = substr($next, 0, strpos($next, '"'));
//       // remove 'amp;'
//       $next = $host . htmlspecialchars_decode($next);
    }

    public function movies () {

      $file = file_get_contents("http://localhost/laravel/peliculas/public/cine.ar/json/movies_03.json");

      $json = json_decode($file);

      $j_movies = $json->prods;

      $source = Source::find(1);
      $source_url1_prefix = "https://play.cine.ar/";
      $source_url2_prefix = "/produccion/";

      foreach ($j_movies as $j_movie) {

        if (Movie::where('title',$j_movie->tit)->first()) {
          dump($j_movie->tit);
          continue;
        }
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

        $j_source = $j_movie->id;

        $url_source = $source_url1_prefix . // https://play.cine.ar/
                      $j_source->source .
                      $source_url2_prefix . // /produccion/
                      $j_source->sid;

        $movie->sources()->attach($source,["url"=>$url_source]);
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
