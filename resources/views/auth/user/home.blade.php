@extends('layouts.app')

@include('layouts/header')
@section('content')
@include('layouts/sidebar')

<div>
@foreach($seat_date as $key => $value)
  <p>{{ $key }}の残りの席数は{{ $value }}</p>
@endforeach

</div>
@endsection
