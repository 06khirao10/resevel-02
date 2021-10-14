@extends('layouts.adminApp')

@section('content')

<div>
    @foreach($dates as $date)
    <p>{{ $list }}</p>
    <a href="{{ route('admin.schedules.store') }}">予約NG日にする</a>
    <a href="{{ route('admin.schedules.store') }}">予約可能日にする</a>
    @endforeach
</div>

@endsection