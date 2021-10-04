 <div>

    <a href="password-edit">プロフィール</a>

    <a href="reservations">予約一覧</a>

    <form action="{{ route('logout') }}" method="POST">
    {{ csrf_field() }}
    <button type="submit">ログアウト</button>
    </form>

</div>
