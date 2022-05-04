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
  @auth
  @if(auth()->user()->admin == 0)
  <thead>
    <tr>
      <th scope="col">Movie</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reservations as $reservation)
    <tr>
      <td>{{ $reservation->title }}</td>
      <td>{{ $reservation->start_time }}</td>
      <td>
        <form method="post" action="{{ route('reservations.destroy', $reservation->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
    @elseif(auth()->user()->admin == 1) <!-- ADMIN -->
    <thead>
    <tr>
        <th scope="col">Movie</th>
        <th scope="col">Time</th>
        <th scope="col">Username</th>
      </tr>
    </thead>
    <tbody>
    @foreach($allReservations as $reservation)
    <tr>
      <td>{{ $reservation->title }}</td>
      <td>{{ $reservation->start_time }}</td>
      <td>{{ $reservation->name }}</td>
      <td>
        <form method="post" action="{{ route('reservations.destroy', $reservation->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
    @endif
    @endauth

  </tbody>
</table>
</div>
@endsection
