<aside>
    <div>
        <p>{{ $admin->name }}</p>
    </div>
    <ul>
        <li><a href="{{ route('admin.passwordEdit') }}">プロフィール編集</a></li>
        <li><a href="{{ route('admin.users.index') }}">ユーザー一覧</a></li>
    </ul>
    <form action="{{ route('admin.logout') }}" method="POST">
    {{ csrf_field() }}
        <button type="submit">ログアウト</button>
    </form>
</aside>
