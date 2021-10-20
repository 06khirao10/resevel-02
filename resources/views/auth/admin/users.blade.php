@extends('layouts.app')

@section('content')
ユーザー一覧
<div class="users">
@foreach ($users as $user)
<div class="list">
  <span>{{ $user->name }}</span>
</div>
@endforeach
@endsection
