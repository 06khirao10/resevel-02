@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" action="{{ route('admin.passwordUpdate') }}">
        @method('PUT')
            @csrf
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">管理者パスワード変更</div>
                                <div class="panel-body">        
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                            <label for="new-password" class="col-md-4 control-label">現在のパスワード</label>
                                                <div class="col-md-6">
                                                    <input id="current-password" type="password" class="form-control" name="current-password" required>
                                                        @if ($errors->has('current-password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('current-password') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                            <label for="new-password" class="col-md-4 control-label">新しいパスワード</label>
                                                <div class="col-md-6">
                                                    <input id="new-password" type="password" class="form-control" name="new-password" required>
                                                        @if ($errors->has('new-password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('new-password') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="new-password-confirm" class="col-md-4 control-label">確認用パスワード</label>
                                                <div class="col-md-6">
                                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">変更</button>
                                        </div>
                        </div>
                    </div>
                </div>
    </form>
</div>                  
@endsection
