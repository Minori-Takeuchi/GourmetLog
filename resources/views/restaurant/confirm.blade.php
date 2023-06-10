@extends('layouts.default')

@section('browser-ttl', '確認')

@section('content')
    <div class="restaurant-form">
      <form  action="/restaurant/form/upsert" method="post">
        @csrf
        <!-- 店名 -->
        <div class="restaurant-form-confirm">
          <p>店名：</p>
          <p>{{ $restaurant['name'] }}</p>
          <input type="hidden" name="name" value="{{ $restaurant['name'] }}">
        </div>

        <!-- フリガナ -->
        <div class="restaurant-form-confirm">
          <p>フリガナ：</p>
          <p>{{ $restaurant['name_katakana'] }}</p>
          <input type="hidden" name="name_katakana" value="{{ $restaurant['name_katakana'] }}">
        </div>

        <!-- カテゴリー -->
        <div class="restaurant-form-confirm">
          <p>カテゴリー：</p>
          @foreach($categories as $category)
          <p>{{ $category['name'] }}</p>
          <input type="hidden" name="category_ids[]" value="{{ $category['id'] }}">
          @endforeach
        </div>

        <!-- レビュー -->
        <div class="restaurant-form-confirm">
          <p>レビュー：</p>
          <p>{{ $restaurant['review'] }}</p>
          <input type="hidden" name="review" value="{{ $restaurant['review'] }}">
        </div>

        <!-- 料理写真 -->
        @if (!empty($restaurant['food_picture']))
        <div class="restaurant-form-confirm">
          <p>料理写真：</p>
          <input type="hidden" name="food_picture" value="{{ $restaurant['food_picture'] }}">
          <div>
            <img src="{{ $restaurant['food_picture'] }}" alt="画像" width="300" height="auto">
            <p>{{ $restaurant['food_picture'] }}</p>
          </div>
        </div>
        @endif

        @if (!empty($restaurant['map_url']))
        <div class="restaurant-form-confirm">
          <p>Google Map：</p>
          <iframe
          width="500px" height="300px" frameborder="0"
          marginwidth="0" marginheight="0"
          src="{{ $restaurant['map_url'] }}">
          </iframe>
          <input type="hidden" name="map_url" value="{{ $restaurant['map_url'] }}">
        </div>
        @endif
        <div class="restaurant-form-confirm">
          <p>電話番号：</p>
          <p>{{ $restaurant['tel'] }}</p>
          <input type="hidden" name="tel" value="{{ $restaurant['tel'] }}">
        </div>
        <div class="restaurant-form-confirm">
          <p>コメント：</p>
          <p>{{ $restaurant['comment'] }}</p>
          <input type="hidden" name="comment" value="{{ $restaurant['comment'] }}">
        </div>


        <!-- 編集の場合 -->
        @if (isset($restaurant))
          <input type="hidden" name="id" value="{{ $restaurant['id'] }}">
        @endif

        <button type="submit" name="action" value="submit">保存する</button>
        <button type="submit" name="back" value="back">修正する</button>
      </form>
    </div>
@endsection
