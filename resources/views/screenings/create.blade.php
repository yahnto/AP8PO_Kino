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
    <form action="{{ route('screenings.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="movie">Movie</label>
            <select class="form-control" id="movie" name="movie">
                @foreach($movies as $movie)
                <option value="{{$movie->id}}">{{$movie->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" aria-describedby="helpId" placeholder="">
        </div>

        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" class="form-control" name="time" id="time" aria-describedby="helpId" placeholder="">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection