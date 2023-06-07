@extends('layouts.default')

@section('browser-ttl', '店舗詳細')

@section('content')
    <div>
        <h2>{{ $restaurant['name'] }}</h2>
        <p>{{ $restaurant['comment'] }}</p>

    </div>
@endsection