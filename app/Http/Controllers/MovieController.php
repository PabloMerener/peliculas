<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact("movies"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $this->validate(request(),[
         'title' => 'required',
         'year' => 'required',
         'movie_image' => 'required'
       ]);

       $file = request()->file('movie_image');
       $extension = $file->extension();
       $movie_image = $request["title"] . '.' .$extension;
       $movie = request(["title", "year"]);
       $movie["movie_image"] = $movie_image;
       $file->storeAs('movies/' , $movie_image);
       Movie::create($movie);

       redirect("/movies");
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {

      // $movie = Movie::with('people')->find($movie);
      // $movie = Movie::with('jobsRoles')->with('people')->find($movie);
      $roles = $movie->jobsRoles->pluck('name','id');
      $people = $movie->people->pluck('name','id');
      // dd($roles,$people,$movie);
      // dd($movie);

      return view("movies.view",compact("movie","roles"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
