@extends('layouts.app')


@section('content')
<div>
  <a href="{{ route('home') }}">前月</a>
</div>

@if (session('error'))
{{-- エラー文表示 --}}
  <div>
    <p style="color:red">{{ session('error') }}</p>
  </div>
@endif

@foreach($seat_date as $key => $value)
  <div>
    {{-- in_arrayで指定した値が配列に存在するか確認 --}}
    {{-- NGな日の値が確認とれらとき、席数を0にする条件分岐 --}}
    @if(in_array($key, $not_date))
      <?php $value = '0'; ?>
    @endif

    <p>{{ $key }}の残りの席数は{{ $value }}</p>

    @if(!in_array($key, $not_date) && $value !== 0)
    {{-- 残席=0じゃないとき。つまり予約できるときは予約ボタン表示する --}}
    <form action="{{ route('reservations.create') }}" method="POST">
      @csrf
      <input name="startDatetime" value="{{ $key }}" type="hidden">
      <button type="submit">予約</button>
    </form>
    @endif
  </div>

@endforeach

</div>
@endsection
