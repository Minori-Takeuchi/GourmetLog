@extends('layouts.default')

@section('browser-ttl', '店舗詳細')

@section('content')
<div class="my-10">
    <table>
        <thead>
            <tr>
                <th class="text-xl">{{ $restaurant['name'] }}</th>
                <th class="text-xl">詳細</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th class="text-xl">{{ $restaurant['name_katakana'] }}</th>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="mt-10">
        <tr>
            <th class="text-xl text-left align-top pr-1">カテゴリー：</th>
            <td class="pr-20 pl-8">
                @foreach($restaurant['categories'] as $category)
                <p>{{ $category['category_name'] }}</p>
                @endforeach
            </td>
            <th class="text-xl text-left align-top w-28">レビュー：</th>
            <td>
                @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $restaurant['review'])
                <span class="text-yellow-400 text-xl">&#9733;</span>
                @else
                <span class="text-gray-500 text-xl">&#9733;</span> {{-- グレーの星マーク --}}
                @endif
                @endfor
            </td>
        </tr>
    </table>
    <table class="mt-10">
        @if (!empty($restaurant['food_picture']))
        <tr>
            <th class="text-xl text-left align-top pr-1">料理写真：</th>
            <td class="pb-8 pl-3">
                <img src="{{ $restaurant['food_picture'] }}" alt="画像" width="300" height="auto">
            </td>
        </tr>
        @endif
        @if (!empty($restaurant['map_url']))
        <tr>
            <th class="text-xl text-left align-top pr-1">Google Map：</th>
            <td class="pb-8 pl-3">
                <iframe
                    width="300" height="250" frameborder="0"
                    marginwidth="0" marginheight="0"
                    src="{{ $restaurant['map_url'] }}">
                </iframe>
            </td>
        </tr>
        @endif
        @if (!empty($restaurant['tel']))
        <tr>
            <th class="text-xl text-left align-top pr-1">電話番号：</th>
            <td class="pb-8 pl-3">{{ $restaurant['tel'] }}</td>
        </tr>
        @endif
        <tr>
            <th class="text-xl text-left align-top">コメント：</th>
            <td class="pb-8 pl-3">{{ $restaurant['comment'] }}</td>
        </tr>

    </table>
        <form action="/restaurant" method="get" class="w-full flex justify-center pt-8">
            @csrf
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded h-10">お店リストに戻る</button>
        </form>
</div>
@endsection
        