@extends('layouts.app')

@section('content')

  @csrf
  <div>
    <p>予約が完了しました</p>
    <p>登録したメールアドレスに完了メールが届きます</p>
  </div>
  <div>
    <a href="{{ route('home') }}">戻る</a>
  </div>

@endsection
