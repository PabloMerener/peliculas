@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-5">
        <div class="thumbnail">
          <img src="{{ Storage::disk('local')->url('people/'. $person->avatar ) }}" alt="" style="width:100%">
        </div>
        <div class="card">
          <div class="card-body">
            {{ $person->name }}
          </div>
        </div>
      </div>

      <div class="col-sm-7">
        <div class="card">
          <div class="card-header">
            Filmografía
          </div>

          <div class="row">
            @foreach ($movies as $movie)
              <div class="col-sm-6">
                <div class="card-body">
                  <div class="card" style="width: 7rem; text-align: center;">
                    {{ $movie->year }}
                    <a href="/movies/{{ $movie->id }}">
                      {{-- <img class="card-img-top" src="{{ Storage::disk('local')->url('posters/'. $movie->movie_image ) }}" alt="Card image cap"> --}}
                      <img class="card-img-top" src="{{ Storage::disk('local')->url('posters/'. $movie->movie_image ) }}" alt="Card image cap">
                    </a>
                    {{ $movie->title }}
                  </div>
                </div>
              </div>
            @endforeach
          </div>

        </div>
      </div>

      {{-- <div class="col-md-6 col-sm-6">
        <div class="card">
          <div class="card-header">
            Filmografía
          </div>
          <div class="card-body">
            <div class="row">
              @foreach ($movies as $movie)
                <div class="col-sm-6">
                  <div class="card" style="width: 7rem; text-align: center;">
                    {{ $movie->year }}
                    <a href="/movies/{{ $movie->id }}">
                    <img class="card-img-top" src="{{ Storage::disk('local')->url('posters/'. $movie->movie_image ) }}" alt="Card image cap">
                    </a>
                    {{ $movie->title }}
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
 --}}

    </div>


  </div>

@endsection
