@extends('layouts.default')

@section('browser-ttl', 'ダッシュボード')

@section('title', $user_name . 'さん　' . $date )

@section('content')
<div class="dashboard">
  <p>{{ $message }}</p>
</div>
@endsection
