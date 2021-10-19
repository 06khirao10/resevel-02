<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>Reservel</title>
  <meta name="description" content="">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body>
  <div id="app">
    @include('layouts/adminHeader')
    <main>
      @include('layouts/adminSidebar')
      @yield('content')
    </main>
  </div>
</body>

</html>
