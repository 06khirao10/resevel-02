@extends('layouts.adminApp')

@section('content')
予約者一覧
<div class= "container">
  @foreach($reservations as $reservation)
  <div class= "contents">
    <span>名前:{{ $reservation->name }}</span>
    <span>開始時間:{{ $reservation->start_datetime }}</span>
    <span>終了時間:{{ $reservation->end_datetime }}</span>
  </div>
  @endforeach
</div>
@endsection