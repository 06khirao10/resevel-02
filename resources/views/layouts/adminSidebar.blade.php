<aside>
  サイドバー
  <form action="{{ route('admin.logout') }}" method="POST">
  {{ csrf_field() }}
    <button type="submit">ログアウト</button>
  </form>
</aside>
