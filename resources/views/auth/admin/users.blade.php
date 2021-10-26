@extends('layouts.app')

@section('content')
ユーザー一覧
<div class="users">
@foreach ($users as $user)
<div class="list">
  <span>{{ $user->name }}</span>
  <a href="{{ route('admin.notice') }}"><span>{{ $user->email }}</span></a>
@endforeach
</div>
@endsection