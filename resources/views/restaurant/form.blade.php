@extends('layouts.default')

@section('browser-ttl', 'お店新規作成/編集')

@section('content')
    <div class="restaurant-form w-1/2 flex justify-center">
      <form  action="/restaurant/form/confirm" method="post" enctype="multipart/form-data">
        @csrf
        <!-- 店名 -->
        <div class="mb-8 w-full">
          <label for="name" class="w-full inline-block">店名<span class="text-sm text-red-600">*</span></label>
          <input type="text" name="name" id="name"
          value="{{ old('name') ?? ($restaurant['name'] ?? '') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60  mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @if ($errors->has('name'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('name') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        <!-- フリガナ -->
        <div class="mb-8">
          <label for="name_katakana">フリガナ<span class="text-sm text-red-600">*</span></label>
          <input type="text" name="name_katakana" id="name_katakana"
          value="{{ old('name_katakana') ?? (isset($restaurant['name_katakana']) ? $restaurant['name_katakana'] : '') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60  mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @if ($errors->has('name_katakana'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('name_katakana') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        <!-- カテゴリー -->
        <div class="mb-8">
          <label for="categories" class="w-full inline-block">カテゴリー<span class="text-sm text-red-600">*</span></label>
          <div class="flex items-center mr-4 flex-wrap">
            @foreach($categories as $category)
            <div class=" w-1/3">
              <input
              type="checkbox" name="category_ids[]" id="category_{{ $category->id }}" value="{{ $category->id }}"
              class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
              {{ isset($restaurant_categories) && in_array($category->id, $restaurant_categories->pluck('id')->toArray()) ? 'checked' : '' }}>
              <label for="category_{{ $category->id }}">{{ $category->name }}</label>
            </div>
            @endforeach
          </div>
          @if ($errors->has('category_ids'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('category_ids') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        <!-- レビュー -->
        <div class="mb-8">
          <label for="review" class="w-full inline-block">レビュー（最高：5/最低：1）<span class="text-sm text-red-600">*</span></label>
          <select name="review" id="review"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" {{ (old('review') ?? ($restaurant['review'] ?? null)) == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
          </select>
          @if ($errors->has('review'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('review') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        <!-- 画像 -->
        <div class="mb-8">
          <label for="food_picture" class="w-full inline-block">画像選択</label>
          <input type="file" name="food_picture" id="food_picture"
          class="rounded border border-gray-300">
        </div>
        <!-- google map -->
        <div class="mb-8">
          <label for="map_url" class="w-full inline-block">Google Map URL</label>
          <input type="text" name="map_url" id="map_url" value="{{ old('map_url') ?? (isset($restaurant['map_url']) ? $restaurant['map_url'] : '') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60  mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>
        <!-- 電話番号 -->
        <div class="mb-8">
          <label for="tel" class="w-full inline-block">電話番号</label>
          <input type="text" name="tel" id="tel" value="{{ old('tel') ?? (isset($restaurant['tel']) ? $restaurant['tel'] : '') }}"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60  mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @if ($errors->has('tel'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('tel') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        <!-- コメント -->
        <div class="mb-8">
          <label for="comment" class="w-full inline-block">コメント<span class="text-sm text-red-600">*</span></label>
          <textarea name="comment" id="comment"
          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 mr-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ old('comment') ?? (isset($restaurant['comment']) ? $restaurant['comment'] : '') }}</textarea>
          @if ($errors->has('comment'))
          <div class="error">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-medium">ERROR</p>
            @foreach($errors->get('comment') as $message)
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"> {{ $message }} </p>
            @endforeach
          </div>
          @endif
        </div>
        
        <!-- 編集の場合(idを渡す) -->
        <input type="hidden" name="id" value="{{ old('id') ?? (isset($restaurant['id']) ? $restaurant['id'] : '')}}">


        <div class="w-1/2 flex justify-center py-8">
          <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded h-10">確認画面へ</button>
        </div>
      </form>
    </div>
@endsection
