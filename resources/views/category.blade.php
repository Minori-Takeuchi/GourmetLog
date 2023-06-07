@extends('layouts.default')

@section('browser-ttl', 'カテゴリー')

@section('content')

<p>haro</p>
@foreach($categories as $category)
    <div>
        <h2>{{ $category->name }}</h2>
        <a href="{{ route('category.index')}}">詳細</a>
    </div>
@endforeach
@endsection