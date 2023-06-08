@extends('layouts.default')

@section('browser-ttl', 'トップ')

@section('content')
<div class="top">
  <form action="/restaurant/search" method="get">
    @csrf
    <input type="text" name="search">
    <button>検索</button>
  </form>
  @foreach($restaurants as $restaurant)
  <div>
    <h2>{{ $restaurant['name'] }}</h2>
    <p>{{ $restaurant['review'] }}</p>
    <form action="/restaurant/show/{{$restaurant['id']}}" method="get">
      @csrf
      <button type="submit">詳細</button>
    </form>
    <form action="/restaurant/edit/{{$restaurant['id']}}" method="get">
      @csrf
      <button type="submit">編集</button>
    </form>
  </div>
  @endforeach
</div>
@endsection
