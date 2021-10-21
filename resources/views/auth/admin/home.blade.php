@extends('layouts.adminApp')

@section('content')

<div>
    <p>TOP画面</p>
</div>
<ul>
    <li><a href="">予約一覧表示</a></li>
    <li><a href="{{ route('admin.schedules') }}">予約NG日設定</a></li>
</ul>

@endsection