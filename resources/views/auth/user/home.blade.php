@extends('layouts.app')


@section('content')
<div>
  <a href="{{ route('nextMonth') }}">次月</a>
</div>

@if (session('error'))
<!-- エラー文表示 -->
  <div>
    <p style="color:red">{{ session('error') }}</p>
  </div>
@endif

@foreach($seat_date as $key => $value)
  <div>
    <p>{{ $key }}の残りの席数は{{ $value }}</p>

    @if($value !== 0)
    <!-- 残席=0じゃないとき。つまり予約できるときは予約ボタン表示する -->
    <form action="{{ route('reservations.create') }}" method="GET">
      @csrf
      <input name="startDatetime" value="{{ $key }}" type="hidden">
      <button type="submit">予約</button>
    </form>
    @endif
  </div>

@endforeach

</div>
@endsection
