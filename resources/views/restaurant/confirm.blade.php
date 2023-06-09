@extends('layouts.default')

@section('browser-ttl', '確認')

@section('content')
    <div class="restaurant-form">
      <form  action="/restaurant/confirm" method="post">
        @csrf
        <div class="restaurant-form-confirm">
          <p>店名：</p>
          <p>{{ $restaurant['name'] }}</p>
        </div>
        <div class="restaurant-form-confirm">
          <p>フリガナ：</p>
          <p>{{ $restaurant['name_katakana'] }}</p>
        </div>
        <div class="restaurant-form-confirm">
          <p>カテゴリー：</p>
          @foreach($categories as $category)
          <p>{{ $category['name'] }}</p>
          @endforeach
        </div>
        <div class="restaurant-form-confirm">
          <p>レビュー：</p>
          <p>{{ $restaurant['review'] }}</p>
        </div>
        @if (isset($restaurant['food_picture']))
        <div class="restaurant-form-confirm">
          <p>料理写真：</p>
          <div>
            <img src="{{ $restaurant['food_picture'] }}" alt="既存の画像">
          </div>
        </div>
        @endif
        <div class="restaurant-form-confirm">
          <p>Google Map：</p>
          <iframe
            width="500px" height="300px" frameborder="0"
            marginwidth="0" marginheight="0"
            src="{{ $restaurant['map_url'] }}">
          </iframe>
        </div>
        <div class="restaurant-form-confirm">
          <p>電話番号：</p>
          <p>{{ $restaurant['tel'] }}</p>
        </div>
        <div class="restaurant-form-confirm">
          <p>コメント：</p>
          <p>{{ $restaurant['comment'] }}</p>
        </div>


        <!-- 編集の場合 -->
        @if (isset($restaurant))
          <input type="hidden" name="id" value="{{ $restaurant['id'] }}">
        @endif

        <button type="submit">確認画面へ</button>
      </form>
    </div>
@endsection
