@extends('layouts.default')

@section('browser-ttl', 'お店新規作成/編集')

@section('content')
    <div class="restaurant-form">
      <form  action="/restaurant/form/confirm" method="post" enctype="multipart/form-data">
        @csrf
        <div class="restaurant-form-input">
          <label for="name">店名</label>
          <input type="text" name="name" id="name"
          value="{{ old('name') ?? ($restaurant['name'] ?? '') }}">
        </div>
        <div class="restaurant-form-input">
          <label for="name_katakana">フリガナ</label>
          <input type="text" name="name_katakana" id="name_katakana"
          value="{{ old('name_katakana') ?? (isset($restaurant['name_katakana']) ? $restaurant['name_katakana'] : '') }}">
        </div>
        <div class="restaurant-form-input">
          <label for="categories">カテゴリー</label>
          @foreach($categories as $category)
          <div>
            <input type="checkbox" name="category_ids[]" id="category_{{ $category->id }}" value="{{ $category->id }}"
            {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
            {{ isset($restaurant_categories) && in_array($category->id, $restaurant_categories->pluck('id')->toArray()) ? 'checked' : '' }}>
            <label for="category_{{ $category->id }}">{{ $category->name }}</label>
          </div>
          @endforeach
        </div>
        
        <div class="restaurant-form-input">
          <label for="review">レビュー（最高：5/最低：1）</label>
          <select name="review" id="review">
            @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" {{ (old('review') ?? ($restaurant['review'] ?? null)) == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
          </select>
        </div>


        <div class="restaurant-form-input">
          <label for="food_picture">画像選択</label>
          <input type="file" name="food_picture" id="food_picture" >
        </div>
        <div class="restaurant-form-input">
          <label for="map_url">Google Map URL</label>
          <input type="text" name="map_url" id="map_url" value="{{ old('map_url') ?? (isset($restaurant['map_url']) ? $restaurant['map_url'] : '') }}">
        </div>
        <div class="restaurant-form-input">
          <label for="tel">電話番号</label>
          <input type="text" name="tel" id="tel" value="{{ old('tel') ?? (isset($restaurant['tel']) ? $restaurant['tel'] : '') }}">
        </div>
        <div class="restaurant-form-input">
          <label for="comment">コメント</label>
          <textarea name="comment" id="comment">{{ old('comment') ?? (isset($restaurant['comment']) ? $restaurant['comment'] : '') }}</textarea>

        </div>

        <!-- 編集の場合 -->
        @if (isset($restaurant))
          <input type="hidden" name="id" value="{{ $restaurant['id'] }}">
        @endif

        <button type="submit">確認画面へ</button>
      </form>
    </div>
@endsection
