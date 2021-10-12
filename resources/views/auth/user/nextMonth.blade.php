@extends('layouts.app')


@section('content')
<div>
  <form action="{{ route('home') }}" method="GET">
    {{ csrf_field() }}
    <button type="submit">前月</button>
  </form>
</div>

@foreach($seat_date as $key => $value)
  <p>{{ $key }}の残りの席数は{{ $value }}</p>
@endforeach

</div>
@endsection
