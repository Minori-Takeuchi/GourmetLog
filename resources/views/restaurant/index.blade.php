@extends('layouts.default')

@section('browser-ttl', 'トップ')

@section('content')
<div class="top">
  <form action="/restaurant/search" method="get">
    @csrf
    <input type="text" name="search">
    <button class="bg-blue-500 hover:bg-blue-700 text-white h- py-2 px-4 rounded">検索</button>
  </form>
  <div>
    <table class="table-auto">
      <thead>
        <tr>
          <th>ID</th>
          <th>店名</th>
          <th>カテゴリー</th>
          <th>レビュー</th>
          <th>コメント</th>
          <th>詳細</th>
          <th>編集</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($restaurants as $restaurant)
        <tr>
          <td>{{ $restaurant['id'] }}</td>
          <td>{{ $restaurant['name'] }}</td>
          @foreach($restaurant['categories'] as $category)
          <td>{{ $category['category_name'] }}</td>
            @endforeach
            <td>{{ $restaurant['review'] }}</td>
            <td>
              @if (strlen($restaurant['comment']) > 25)
              {{ mb_substr($restaurant['comment'], 0, 25) . '...' }}
              @else
              {{ $restaurant['comment'] }}
              @endif
            </td>
            <td>
              <form action="/restaurant/show/{{$restaurant['id']}}" method="get">
                @csrf
                <button type="submit" class="bg-green-500 hover:bg-green-700 h-12 text-white py-2 px-4 rounded-full">詳細</button>
              </form>
            </td>
            <td>
              <form action="/restaurant/edit/{{$restaurant['id']}}" method="get">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 h-12 text-white py-2 px-4 rounded-full">編集</button>
              </form>
            </td>
            <td>
              <form action="/restaurant/delete/{{$restaurant['id']}}" method="post" onsubmit="return confirm('削除してもよろしいですか？')">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 h-12 text-white py-2 px-4 rounded-full">削除</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection
