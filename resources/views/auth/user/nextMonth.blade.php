@extends('layouts.app')


@section('content')
<div>
  <a href="{{ route('home') }}">前月</a>
</div>

@foreach($seat_date as $key => $value)
  <p>{{ $key }}の残りの席数は{{ $value }}</p>
@endforeach

</div>
@endsection
