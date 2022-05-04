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
      <th scope="col">Movie</th>
      <th scope="col">Start Time</th>
      <th scope="col">Count</th>
    </tr>
  </thead>
  <tbody>
    @foreach($screenings as $screening)
    <tr>
      <td>{{ $screening->title }}</td>
      <td>{{ $screening->start_time }}</td>
      <td>{{ $screening->nOfReservations }} / 30</td>
      @auth
      @if(auth()->user()->admin == 0)
      <td>
      @if($screening->nOfReservations != 30 )
      <form method="post" action="{{ route('reservations.store') }}">
          @csrf
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="hidden" id="" name='screening_id' value="{{$screening->id}}">
          </div>
          <button class="btn btn-primary" type="submit">Reserve</button>
        </form>
      @else
      <div class="container">
        Out of stock!
      </div>
      @endif
      </td>
      @elseif(auth()->user()->admin == 1) <!-- ADMIN -->
      <td>
        <form method="post" action="{{ route('screenings.destroy', $screening->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger" type="submit">Delete</button>
        </form>
      </td>
      @endif
      @endauth
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
