@extends('layouts.default')

@section('browser-ttl', 'カテゴリー編集')

@section('content')
    <div class="category-form">
      <form  action="/category/update/{id}" method="post">
        @csrf
        <div class="category-form-input">
          <label for="name">カテゴリー名</label>
          <input type="text" name="name" id="name"
          value="{{ $category['name'] ?? '' }}">
        </div>
        <input type="hidden" name="id" value="{{ $category['id'] }}">
        <button type="submit">修正</button>
      </form>
      <form action="/category">
        @csrf
        <button type="submit">戻る</button>
      </form>
    </div>
@endsection
