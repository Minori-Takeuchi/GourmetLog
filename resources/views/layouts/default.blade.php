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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  
</head>

<body>
  <div class="container flex flex-row">
    <div class="manu">
      <h1>Gourmet Log</h1>
      <div>MENU</div>
      <div class="pt-4 pb-1 border-t border-gray-200">
        <a href="{{route('top')}}">お店リスト</a><br>
        <a href="{{route('restaurant.form')}}">お店登録/編集</a><br>
        <a href="{{route('category.top')}}">カテゴリー管理</a>
        <form action="/restaurant" method="get">
          @csrf

        </form>
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('LogOut') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    <div>
      <h1 class="ttl">@yield('title')</h1>
      <div class="wrap">@yield('content')</div>
    </div>
  </div>
</body>


</html>