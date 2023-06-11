@extends('layouts.default')

@section('browser-ttl', 'ダッシュボード')

@section('content')
<div class="dashboard">
  <p>{{ $user_name }}　{{ $date }}</p>
  <p>{{ $message }}</p>
</div>
@endsection
