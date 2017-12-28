@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="thumbnail">
          <a href="#">
            <img src="{{ Storage::disk('local')->url('posters/'. $movie->movie_image ) }}" alt="" style="width:100%">
          </a>
        </div>
        <div class="card">
          <div class="card-body" style="text-align:right;">
            {{ $movie->title }} / {{ $movie->year }}
          </div>
        </div>
        <div class="card" style="text-align:center;">
          @foreach ($genres as $id => $name)
            <div class="card-body">
              <a href="/genres/{{ $id }}" class="btn btn-primary">{{ $name }}</a>
            </div>
          @endforeach
        </div>
        <div class="card">
          <div class="card-body">
            {{ $movie->synopsis }}
          </div>
        </div>
      </div>

      <div class="col-md-6 col-sm-6">
        @foreach ($roles as $key => $value)
          <div class="card">
            <div class="card-header">
              {{ $value }}
            </div>
            <div class="card-body">
              <div class="row">
                @foreach ($movie->people as $person)
                  @if ($person->pivot->job_role_id == $key)
                    <div class="col-sm-6">
                      <div class="card" style="width: 7rem; text-align: center;">
                        <a href="/people/{{ $person->id }}">
                          <img class="card-img-top" src="{{ Storage::disk('local')->url('people/'. $person->avatar ) }}" alt="Card image cap">
                        </a>
                        {{ $person->name }}
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

@endsection
