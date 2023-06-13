@extends('layouts.default')

@section('browser-ttl', 'トップ')

@section('content')
<div class="w-full p-8 flex justify-center">
  <div>
    <form action="/restaurant/search" method="get" class="flex w-full">
      @csrf
      <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60  mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="店舗名">
      <button class="bg-blue-500 hover:bg-blue-700 text-white h- py-2 px-4 rounded">検索</button>
    </form>
    <div>
      <table class="table-auto mt-8">
        <thead>
          <tr>
            <th class="border px-2 py-2 text-center text-sm">ID</th>
            <th class="border px-2 py-2 text-center text-sm">店名</th>
            <th class="border px-2 py-2 text-center text-sm">カテゴリー</th>
            <th class="border px-2 py-2 text-center text-sm">レビュー</th>
            <th class="border px-2 py-2 text-center text-sm">コメント</th>
            <th class="border px-2 py-2 text-center text-sm">詳細</th>
            <th class="border px-2 py-2 text-center text-sm">編集</th>
            <th class="border px-2 py-2 text-center text-sm">削除</th>
          </tr>
        </thead>
        <tbody>
          @foreach($restaurants as $restaurant)
          <tr>
            <td class="border py-2 text-center text-sm">{{ $restaurant['id'] }}</td>
            <td class="border py-2 text-center text-sm">{{ $restaurant['name'] }}</td>
            <td class="border px-2 py-2 text-center text-sm">
              @foreach($restaurant['categories'] as $category)
              <p>{{ $category['category_name'] }}</p>
              @endforeach
            </td>
              <td class="border py-2 text-center">
                @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $restaurant['review'])
                <span class="text-yellow-400 text-sm">&#9733;</span>
                @else
                <span class="text-gray-500 text-sm">&#9733;</span> {{-- グレーの星マーク --}}
                @endif
                @endfor
              </td>
              <td class="border px-2 py-2 text-center text-sm">
                @if (strlen($restaurant['comment']) > 10)
                {{ mb_substr($restaurant['comment'], 0, 10) . '...' }}
                @else
                {{ $restaurant['comment'] }}
                @endif
              </td>
              <td class="border py-2 px-2 text-center text-sm">
                <form action="/restaurant/show/{{$restaurant['id']}}" method="get">
                  @csrf
                  <button type="submit" class="bg-green-500 hover:bg-green-700 w-16 text-white py-2 rounded-full text-sm">詳細</button>
                </form>
              </td>
              <td class="border py-2 px-2 text-center text-sm">
                <form action="/restaurant/edit/{{$restaurant['id']}}" method="get">
                  @csrf
                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 w-16 text-white py-2 rounded-full text-sm">編集</button>
                </form>
              </td>
              <td class="border py-2 px-2 text-center text-sm">
                <form action="/restaurant/delete/{{$restaurant['id']}}" method="post" onsubmit="return confirm('削除してもよろしいですか？')">
                  @csrf
                  <button type="submit" class="bg-red-500 hover:bg-red-700 w-16 text-white py-2 rounded-full text-sm">削除</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
