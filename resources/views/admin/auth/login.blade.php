<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form class="box" action="{{ route('admin.login') }}" method="post">
        @csrf
        <h1>Reservel管理ログイン画面</h1>
        <input type="text" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="" value="Login">
    </form>
</body>
</html>
