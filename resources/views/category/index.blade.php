@extends('layouts.default')

@section('browser-ttl', 'カテゴリー一覧')

@section('content')
<div class="category">
  <form action="/category/search" method="get">
    @csrf
    <input type="text" name="search">
    <button class="bg-blue-500 hover:bg-blue-700 text-white h- py-2 px-4 rounded">検索</button>
  </form>
  <div>
    <table class="table-auto">
      <thead>
        <tr>
          <th>ID</th>
          <th>カテゴリー</th>
          <th>編集</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>{{ $category['id'] }}</td>
          <td>{{ $category['name'] }}</td>
            <td>
              <form action="/category/edit/{{$category['id']}}" method="get">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 h-12 text-white py-2 px-4 rounded-full">編集</button>
              </form>
            </td>
            <td>
              <form action="/category/delete/{{$category['id']}}" method="post" onsubmit="return confirm('削除してもよろしいですか？')">
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
