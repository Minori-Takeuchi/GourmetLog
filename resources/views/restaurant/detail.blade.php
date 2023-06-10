@extends('layouts.default')

@section('browser-ttl', '店舗詳細')

@section('content')
    <div>
        <table>
            <thead>
                <tr>
                    <th>{{ $restaurant['name'] }}　詳細</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $restaurant['name_katakana'] }}</td>
                </tr>
            </tbody>
        </table>
        <table>
        <tr>
            <th>カテゴリー：</th>
            @foreach($restaurant['categories'] as $category)
            <td>{{ $category['category_name'] }}</td>
            @endforeach
        </tr>
        @if (!empty($restaurant['food_picture']))
        <tr>
            <th>料理写真：</th>
            <td>
                <img src="{{ $restaurant['food_picture'] }}" alt="画像" width="300" height="auto">
            </td>
        </tr>
        @endif
        <tr>
            <th>レビュー：</th>
            <td>{{ $restaurant['review'] }}</td>
        </tr>
        @if (!empty($restaurant['map_url']))
        <tr>
            <th>Google Map：</th>
            <td>
                <iframe
                width="500px" height="300px" frameborder="0"
                marginwidth="0" marginheight="0"
                src="{{ $restaurant['map_url'] }}">
                </iframe>
            </td>
        </tr>
        @endif
        <tr>
            <th>電話番号：</th>
            <td>{{ $restaurant['tel'] }}</td>
        </tr>
        <tr>
            <th>コメント：</th>
            <td>{{ $restaurant['comment'] }}</td>
        </tr>
    </table>
</div>
@endsection
        