@extends('layouts.adminApp')

@section('content')

<div class= "container">
  @foreach($reservations as $reservation)
  <div class= "contents">
  名前
  <span>{{ $reservation->name }}</span>
　開始時間
  <span>{{ $reservation->start_datetime }}</span>
  終了時間
  <span>{{ $reservation->end_datetime }}</span>
  </div>
@endforeach
</div>

@endsection