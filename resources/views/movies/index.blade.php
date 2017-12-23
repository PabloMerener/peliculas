{{-- https://startbootstrap.com/
https://startbootstrap.com/template-overviews/thumbnail-gallery/
https://blackrockdigital.github.io/startbootstrap-thumbnail-gallery/ --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> --}}

@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      @foreach ($movies as $movie)
        <div class="col-md-2 col-sm-6">
          <div class="thumbnail">
            <a href="/movies/{{ $movie->id }}">
              <img src="{{ Storage::disk('local')->url('posters/'. $movie->movie_image ) }}" alt="" style="width:100%">
              <div class="caption">
                <p>{{ $movie->title }}</p>
              </div>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
{{-- </body>
</html> --}}

@endsection
