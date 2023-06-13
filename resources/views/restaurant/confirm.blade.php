@extends('layouts.default')

@section('browser-ttl', '確認')

@section('content')
    <div class="restaurant-form w-full flex justify-center my-10 ml-8">
      <form action="/restaurant/form/upsert" method="post">
        @csrf
        <table>
          <!-- 店名 -->
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">店名：</th>
            <td class="pr-20 pl-8 pb-8">{{ $restaurant['name'] }}</td>
            <input type="hidden" name="name" value="{{ $restaurant['name'] }}">
          </tr>
          <!-- フリガナ -->
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">フリガナ：</th>
            <td class="pr-20 pl-8 pb-8">{{ $restaurant['name_katakana'] }}</td>
            <input type="hidden" name="name_katakana" value="{{ $restaurant['name_katakana'] }}">
          </tr>
          <!-- カテゴリー -->
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">カテゴリー：</th>
            <td class="pr-20 pl-8 pb-8">
              @foreach($categories as $category)
              <p>{{ $category['name'] }}</p>
              <input type="hidden" name="category_ids[]" value="{{ $category['id'] }}">
              @endforeach
            </td>
          </tr>
          <!-- レビュー -->
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">レビュー：</th>
            <td class="pr-20 pl-8 pb-8">
              @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $restaurant['review'])
                <span class="text-yellow-400 text-xl">&#9733;</span>
                @else
                <span class="text-gray-500 text-xl">&#9733;</span>
                @endif
                @endfor
            </td>
            <input type="hidden" name="review" value="{{ $restaurant['review'] }}">
          </tr>
          <!-- 料理写真 -->
          @if (!empty($restaurant['food_picture']))
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">料理写真：</th>
            <input type="hidden" name="food_picture" value="{{ $restaurant['food_picture'] }}">
            <td class="pr-20 pl-8 pb-8">
              <img src="{{ $restaurant['food_picture'] }}" alt="画像" width="300" height="auto">
            </td>
          </tr>
          @endif
          @if (!empty($restaurant['map_url']))
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">Google Map：</th>
            <td class="pr-20 pl-8 pb-8">
              <iframe
              width="300" height="200" frameborder="0"
              marginwidth="0" marginheight="0"
              src="{{ $restaurant['map_url'] }}">
              </iframe>
            </td>
            <input type="hidden" name="map_url" value="{{ $restaurant['map_url'] }}">
          </tr>
          @endif
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">電話番号：</th>
            <td class="pr-20 pl-8 pb-8">{{ $restaurant['tel'] }}</td>
            <input type="hidden" name="tel" value="{{ $restaurant['tel'] }}">
          </tr>
          <tr class="restaurant-form-confirm">
            <th class="text-xl text-left align-top pr-1">コメント：</th>
            <td class="pr-20 pl-8 pb-8">{{ $restaurant['comment'] }}</td>
            <input type="hidden" name="comment" value="{{ $restaurant['comment'] }}">
          </tr>
        </table>


        <!-- 編集の場合 -->
        @if (isset($restaurant))
          <input type="hidden" name="id" value="{{ $restaurant['id'] }}">
        @endif

        <button type="submit" name="back" value="back" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded h-10">修正する</button>
        <button type="submit" name="action" value="submit" class="bg-emerald-500 hover:bg-emerald-700 text-white h- py-2 px-4 rounded">登録する</button>
      </form>
    </div>
@endsection
