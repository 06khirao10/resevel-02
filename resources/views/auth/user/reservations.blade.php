@extends('layouts.app')

@section('content')
予約一覧
@if (session('error'))
{{-- エラー文表示 --}}
  <div>
    <p style="color:red">{{ session('error') }}</p>
  </div>
@endif
<div class="reservations">
@foreach ($reservations as $reservation)
<div class="list">
  開始時間
  <span>{{ $reservation->start_datetime }}</span>
  終了時間
  <span>{{ $reservation->end_datetime }}</span>
  <td><a class="btn btn-primary" href="{{ route('updateHome', $reservation ) }}">更新</a></td>

  <form method="post" action="{{ route('reservations.destroy',$reservation) }}">
  @csrf
  @method('DELETE')
    <input type="submit" value="削除" onclick="return confirm('こちらの予約を削除してもよろしいでしょうか？')"></input>
  </from>
</div>
@endforeach
@endsection
