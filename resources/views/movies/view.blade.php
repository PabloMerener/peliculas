@extends('layouts.master')

@section('content')

  <div class="container">
    <div class="row">

      <div class="col-md-6 col-sm-6">
        <div class="thumbnail">
          <a href="#">
            <img src="{{ Storage::disk('local')->url('posters/'. $movie->movie_image ) }}" alt="" style="width:100%">
            {{-- <div class="caption">
            <p>{{ $movie->title }}</p>
          </div> --}}
        </a>
      </div>
    </div>

    <div class="col-md-6 col-sm-6">

      <div class="comments">
        @foreach ($roles as $key => $value)
          <article>
            {{ $value }}:
            <div class="comments">
              @foreach ($movie->people as $person)
                @if ($person->pivot->job_role_id == $key)
                  <article>
                    {{ $person->name }}
                  </article>
                @endif
              @endforeach
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <p>{{ $movie->synopsis }}</p>
    </div>
  </div>
</div>

@endsection
