@extends('layouts.adminApp')

@section('content')

<div>
    @foreach($dates as $date)
    <?php
        //date型を文字列に
        $date_str = date('Y/m/d',strtotime($date));
    ?>
    <p>{{ $date_str }}</p>

    @if(!in_array($date,array_column($button,'date')))
    <form action="{{ route('admin.schedules.store') }}" method="POST">
        @csrf
        <input type="hidden" name="add" value="{{ $date }}">
        <button type="submit" name="">予約NG日にする</button>
    </form>
    @else
    <form action="{{ route('admin.schedules.destroy') }}" method="POST">
        @csrf
        <input type="hidden" name="remove" value="{{ $date }}">
        <button type="submit" name="">予約可能日にする</button>
    </form>
    @endif

    @endforeach
</div>

@endsection