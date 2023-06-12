<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('browser-ttl')</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  
</head>

<body class="w-screen h-screen">
  <div class="flex flex-row w-full h-full relative">
    <div class="manu w-1/6 bg-teal-400 text-white fixed h-full relative">
      <h1 class="text-center w-full inline-block text-xl font-bold py-8">Gourmet Log</h1>
      <div class="text-center w-full border-t border-b border-gray-200 text-xl py-2">MENU</div>
      <div class="w-full">
        <form method="GET" action="{{ route('top') }}">
          @csrf
          <button type="submit" class="hover:text-gray-500 hover:bg-white taxt-center w-full py-2 h-12">お店リスト</button>
        </form>
        <form method="GET" action="{{route('restaurant.form')}}">
          @csrf
          <button type="submit" class="hover:text-gray-500 hover:bg-white taxt-center w-full py-2">お店登録/編集</button>
        </form>
        <form method="GET" action="{{route('category.top')}}">
          @csrf
          <button type="submit" class="hover:text-gray-500 hover:bg-white taxt-center w-full py-2">カテゴリー管理</button>
        </form>
        <form method="POST" action="{{ route('logout') }}"
        onsubmit="return confirm('ログアウトしますか？')" 
        class="absolute bottom-10 w-full">
          @csrf
          <button type="submit" class="hover:text-gray-500 hover:bg-white taxt-center w-full py-2">{{ Auth::user()->name }}</button>
        </form>
      </div>
    </div>
    <div class="w-5/6 absolute inset-y-0 right-0">
      <h1 class="text-xl font-bold p-8">@yield('title')</h1>
      <div class="wrap w-full p-8 flex justify-center">@yield('content')</div>
    </div>
  </div>
</body>


</html>