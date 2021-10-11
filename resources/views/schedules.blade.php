@extends('layouts.adminApp')

@section('content')

<div>
    @foreach($seat_date as $list)
    <p>{{ $list }}</p>
    @endforeach
</div>

@endsection