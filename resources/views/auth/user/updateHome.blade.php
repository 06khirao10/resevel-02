@extends('layouts.app')


@section('content')
@foreach($seat_date as $key => $value)
  <div>
    <p>{{ $key }}の残りの席数は{{ $value }}</p>

    @if($value !== 0)
    {{-- 残席=0じゃないとき。つまり予約できるときは予約ボタン表示する--}}
    <form action="{{ route('reservations.update',  $id  ) }}" method="POST">
      @csrf
      <input name="startDatetime" value="{{ $key }}" type="hidden">
      <button type="submit">更新</button>
    </form>
    @endif
  </div>

@endforeach

</div>
@endsection
