@extends('layouts.app')


@section('content')

<div>
@foreach($seat_date as $key => $value)
  <p>{{ $key }}の残りの席数は{{ $value }}</p>
@endforeach

</div>
@endsection
