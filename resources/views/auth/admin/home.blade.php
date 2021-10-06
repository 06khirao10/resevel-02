@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>管理者ホーム</h3>
            @csrf
        <div class="button">
            <a href ="{{ route('admin.passwordEdit') }}">プロフィール</a>
        </div>
    </div>
@endsection