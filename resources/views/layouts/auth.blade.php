<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('browser-ttl')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  <link href="css/style.css" rel="stylesheet">
  
</head>

<header class="flex justify-between w-full h-24 bg-teal-400 items-center fixed top-0 z-10">
  <div class="logo">Gourmet Log</div>
  <nav class="header-nav flex w-1/3">
    <div><a href="{{ route('login') }}">ログイン</a></div>
    <div><a href="{{ route('register') }}">新規登録</a></div>
  </nav>
</header>
<body class="w-screen h-screen overflow-hidden">

@yield('content')

</body>


</html>