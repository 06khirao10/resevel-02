@extends('layouts.adminApp')

@section('content')
<div>
  <p>メールを送信しました</p>
</div>
<div>
  <a href="{{ route('admin.home') }}">戻る</a>
</div>
@endsection