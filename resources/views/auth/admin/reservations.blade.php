@extends('layouts.adminApp')

@section('content')
@csrf
<div class= "container_seat">
  @foreach((array)$seat_date as $seat_date)
  <p>{{ $seat_date }}</p>
  @endforeach
</div>
<div class= "container">
  @foreach($booking as $booking)
  <li>{{ optional($booking)->name }}<br>{{ optional($booking)->start_datetime }}</li>
  @endforeach
</div>

@endsection