@extends('layouts.app')

@section('content')
予約一覧
<div class="reservations">
@foreach ($reservations as $reservation)
<div class="list">
  開始時間
  <span>{{ $reservation->start_datetime }}</span>
  終了時間
  <span>{{ $reservation->end_datetime }}</span>
  <td><a class="btn btn-primary" href="">更新</a></td>
  <span><a class="btn btn-danger" href="" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></span>
</div>
@endforeach
@endsection
