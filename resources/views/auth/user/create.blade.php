@extends('layouts.app')

@section('content')
<form action="{{ route('reservations.store') }}" method="POST">
  @csrf
  <div>
    <label>日時</label>
    <span>{{ $startDatetime }}</span>
    <input type="hidden" name="startDatetime" value="{{ $startDatetime }}">
  </div>

    <label>要件</label>
    <textarea name="requirements"></textarea>

    <p>この内容で予約確定してよろしいですか？</p>

    <button type="submit">予約する</button>
  <div>
    <a href="{{ route('home') }}">戻る</a>
  </div>

</form>
@endsection
