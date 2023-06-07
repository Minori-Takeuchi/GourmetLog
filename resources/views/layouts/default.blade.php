<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('browser-ttl')</title>
  <!-- <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <script src="{{ asset('js/main.js') }}"></script> -->

  
</head>

<body>
  <div class="container">
    <h1 class="ttl">@yield('title')</h1>
    <div class="wrap">@yield('content')</div>
  </div>
</body>


</html>