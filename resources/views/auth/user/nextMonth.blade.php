@extends('layouts.app')


@section('content')
<div>
  <a href="{{ route('home') }}">前月</a>
</div>

@foreach($seat_date as $key => $value)
  <div>
    <p>{{ $key }}の残りの席数は{{ $value }}</p>

    <form action="{{ route('reservations.create') }}" method="GET">
      @csrf
      <input name="startDatetime" value="{{ $key }}" type="hidden">
      <button type="submit">予約</button>
    </form>
  </div>

@endforeach

</div>
@endsection
