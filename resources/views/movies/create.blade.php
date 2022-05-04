@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container">
    <form action="{{ route('movies.index')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
            <label for="length">Length</label>
            <input type="text" class="form-control" name="length" id="length" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" class="form-control" name="genre" id="genre" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" class="form-control" name="language" id="language" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
            <label for="actors">Actors</label>
            <input type="text" class="form-control" name="actors" id="actors" aria-describedby="helpId" placeholder="">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection