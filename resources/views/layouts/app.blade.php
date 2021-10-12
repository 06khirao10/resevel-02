<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>カレンダー予約状況</title>

    <!-- css -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="responsive.css">

</head>

<body>
  <div id="app">
    @auth
    @include('layouts/header')
    <main>
    @include('layouts/sidebar')
    @endauth
    @yield('content')
    </main>
  </div>
</body>

</html>
