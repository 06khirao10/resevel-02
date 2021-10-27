@extends('layouts.adminApp')

@section('content')
<div class="container">
  <h3>お知らせメール送信フォーム</h3>
  <form action="{{ route('admin.confirm') }}" method="POST">
    @csrf
    <div>
      <label>日時</label>
    </div>
      <select name="date">
        @foreach($dates as $date)
        <option>{{ $date }}</option>
        @endforeach
      </select>
      <select name="start_time">
        <option value="10:00:00">10:00:00</option>
        <option value="11:00:00">11:00:00</option>
        <option value="12:00:00">12:00:00</option>
        <option value="13:00:00">13:00:00</option>
        <option value="14:00:00">14:00:00</option>
        <option value="15:00:00">15:00:00</option>
        <option value="16:00:00">16:00:00</option>
        <option value="17:00:00">17:00:00</option>
      </select>
      <span>〜</span>
      <select name="end_time">
        <option value="11:00:00">11:00:00</option>
        <option value="12:00:00">12:00:00</option>
        <option value="13:00:00">13:00:00</option>
        <option value="14:00:00">14:00:00</option>
        <option value="15:00:00">15:00:00</option>
        <option value="16:00:00">16:00:00</option>
        <option value="17:00:00">17:00:00</option>
        <option value="18:00:00">18:00:00</option>
      </select>
    <div>
      <label>本文</label>
      <textarea name="body" id="body" class="form-control" rows="5" placeholder>上記時間帯の枠が空いた為来社可能です。来社される方は事前にご連絡ください。</textarea>
    </div>
      <button type="submit">送信</button>
    <div>
      <a href="{{ route('admin.home') }}">戻る</a>
    </div>
  </form>
</div>
@endsection