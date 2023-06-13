<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('browser-ttl')</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <script src="{{ mix('js/app.js') }}"></script>
  
</head>

<body class="w-screen h-screen relative">


      
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 " aria-label="Sidebar">
   <div class="h-full py-4 overflow-y-auto bg-teal-400 text-white text-center">
    <h1 class="text-center w-full inline-block text-xl font-bold py-8">Gourmet Log</h1>
    <div class="text-center w-full border-t border-b border-gray-200 text-xl py-2 mb-5">MENU</div>
    <ul class="space-y-2 font-medium">
      <li>
        <form method="GET" action="{{ route('top') }}">
          <button type="submit" class="p-2 text-white hover:bg-gray-100 hover:text-gray-500 w-full text-center">お店リスト</button>
        </form>
      </li>
      <li>
        <form method="GET" action="{{route('restaurant.form')}}">
          @csrf
          <button type="submit" class="p-2 text-white hover:bg-gray-100 hover:text-gray-500 w-full text-center">お店登録/編集</button>
        </form>
      </li>
      <li>
        <form method="GET" action="{{route('category.top')}}">
          @csrf
          <button type="submit" class="p-2 text-white hover:bg-gray-100 hover:text-gray-500 w-full text-center">カテゴリー管理</button>
        </form>
      </li>
      <li>
        <form method="POST" action="{{ route('logout') }}"
          onsubmit="return confirm('ログアウトしますか？')"
          >
            @csrf
            <button type="submit" class="p-2 h-12 text-white hover:bg-gray-100 hover:text-gray-500 w-full text-center absolute bottom-10 left-0">{{ Auth::user()->name }}</button>
          </form>
      </li>
         
    </ul>
   </div>
</aside>

    <div class="inset-y-0 right-0">
      <h1 class="text-xl font-bold">@yield('title')</h1>
      <div class="wrap w-full flex justify-center">@yield('content')</div>
    </div>
  </div>
</body>


</html>