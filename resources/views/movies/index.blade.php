@extends('layouts.app')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@section('content')
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Length</th>
      <th scope="col">Genre</th>
      <th scope="col">Language</th>
      <th scope="col">Actors</th>
    </tr>
  </thead>
  <tbody>
    @foreach($allMovies as $movie)
    <tr>
      <th scope="row">{{ $movie->id }}</th>
      <td>{{ $movie->title }}</td>
      <td>{{ $movie->length }}</td>
      <td>{{ $movie->genre }}</td>
      <td>{{ $movie->language }}</td>
      <td>{{ $movie->actors }}</td>
      <td>
      <a class="btn btn-primary" href="{{ route('movies.edit', $movie->id) }}" role="button">Edit</a>
      </td>
      <td>
        <form method="post" action="{{ route('movies.destroy', $movie->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
