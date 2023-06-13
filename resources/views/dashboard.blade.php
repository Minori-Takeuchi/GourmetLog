@extends('layouts.default')

@section('browser-ttl', 'ダッシュボード')


@section('content')
<div class="dashboard mt-10">
  <p class="my-10 text-xl">{{ $user_name }}さん　{{$date}}</p>
  <p>{{ $message }}</p>
</div>
@endsection
