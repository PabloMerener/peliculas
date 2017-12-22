@extends('layouts.master')

@section('content')

  <h1>Create movie</h1>

  <hr>

  <form method="post" action="/movies" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Title</label>
      <input type="text" class="form-control" id="exampleInputText" name="title" placeholder="Title" >
    </div>

    <div class="form-group">
      <label for="year">Year</label>
      <input type="number" min="1900" max="2030" class="form-control" name="year" placeholder="Year" >
    </div>

    <div class="form-group">
      <input type="file" class="form-control-file" id="exampleFormControlFile1" name="movie_image">
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    @include('layouts.errors')

  </form>

@endsection
