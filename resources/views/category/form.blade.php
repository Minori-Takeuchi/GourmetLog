@extends('layouts.default')

@section('browser-ttl', 'カテゴリー編集')

@section('content')
    <div class="w-1/2 flex justify-center flex-wrap">
      <h1 class="text-xl my-8 w-full text-center">カテゴリー編集</h1>
      <form  action="/category/update/{id}" method="post">
        @csrf
        <div class="mb-8 w-full">
          <label for="name" class="w-full inline-block">カテゴリー名</label>
          <input type="text" name="name" id="name"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60  mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          value="{{ $category['name'] ?? '' }}">
          @if ($errors->has('name'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('name') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        <input type="hidden" name="id" value="{{ $category['id'] }}">
        <div class="flex justify-between">
          <button type="submit" name="back" value="back" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded h-10">戻る</button>
          <button type="submit" name="action" value="submit" class="bg-emerald-500 hover:bg-emerald-700 text-white h- py-2 px-4 rounded">修正</button>
        </div>
      </form>
    </div>
@endsection
