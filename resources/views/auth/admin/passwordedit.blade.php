@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <form action="{{ route('admin.passwordUpdate') }}" method="post">
        @method('PUT')
        @csrf
      <div class="card-header">管理者パスワード変更</div>
        {{-- エラーメッセージ --}}
        @if(count($errors) > 0)
        <div class="container mt-2">
          <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
          </div>
        </div>
        @endif
        {{-- 更新成功メッセージ --}}
        @if(session('success'))
        <div class="container mt-2">
          <div class="alert alert-success">
          {{session('success')}}
          </div>
        </div>
        @endif
        {{-- フォーム --}}
        <div class="form-group">
          <label for="password">新しいパスワード</label>
          <div>
            <input id="password" type="password" class="form-control" name="new-password" required>
          </div>
          <div class="form-group">
            <label for="confirm">新しいパスワード（確認用）</label>
            <div>
              <input id="confirm" type="password" class="form-control" name="new-password_confirmation" required>
              <button type="submit" class="btn btn-primary">変更</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection