@extends('layouts.default')

@section('browser-ttl', 'トップ')

@section('content')

<p>haro</p>
@foreach($restaurants as $restaurant)
    <div>
        <h2>{{ $restaurant['name'] }}</h2>
        <p>{{ $restaurant['review'] }}</p>
        <form action="/restaurant/{{$restaurant['id']}}" method="get">
          @csrf
          <button class="search-btn">詳細</button>
        </form>
    </div>
@endforeach
@endsection
