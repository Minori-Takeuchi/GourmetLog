@extends('layouts.default')

@section('browser-ttl', 'カテゴリー一覧')

@section('content')
<div class="w-full p-8 flex justify-center">
  <div class="flex justify-center flex-wrap ml-36">
    <form action="/category/search" method="get" class="flex w-full">
      @csrf
      <input type="text" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="カテゴリー名">
      <button class="bg-blue-500 hover:bg-blue-700 text-white h- py-2 px-4 rounded">検索</button>
    </form>
    <div class="w-full">
      <table class="table-auto mt-8">
        <thead>
          <tr>
            <th class="border px-4 py-2 text-center text-sm">ID</th>
            <th class="border px-4 py-2 text-center text-sm w-5/12">カテゴリー</th>
            <th class="border px-4 py-2 text-center text-sm">編集</th>
            <th class="border px-4 py-2 text-center text-sm">削除</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td class="border px-4 py-2 text-center text-sm">{{ $category['id'] }}</td>
            <td class="border px-4 py-2 text-center text-sm">{{ $category['name'] }}</td>
            <td class="border px-4 py-2 text-center text-sm">
              <form action="/category/edit/{{$category['id']}}" method="get">
                @csrf
                <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 w-16 text-white py-2 px-4 rounded-full @if ($category['user_id'] != Auth::user()->id) opacity-50 cursor-not-allowed @endif"
                @if ($category['user_id'] != Auth::user()->id) disabled @endif>編集</button>
              </form>
            </td>
            <td class="border px-4 py-2 text-center text-sm">
              <form action="/category/delete/{{$category['id']}}" method="post" onsubmit="return confirm('削除してもよろしいですか？')">
                @csrf
                <button type="submit"
                class="bg-red-500 hover:bg-red-700 w-16 text-white py-2 px-4 rounded-full @if ($category['user_id'] != Auth::user()->id) opacity-50 cursor-not-allowed @endif"
                @if ($category['user_id'] != Auth::user()->id) disabled @endif>削除</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{$categories->links()}}
  </div>
</div>
@endsection

