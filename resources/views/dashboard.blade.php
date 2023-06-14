@extends('layouts.default')

@section('browser-ttl', 'ダッシュボード')


@section('content')
<div class="dashboard my-10 px-10">
  <p class="my-10 text-xl">{{ $user_name }}さん　{{$date}}</p>
  <p>{{ $message }}</p>
  
  <h3 class="mt-10 mb-5 text-xl">&#9733;京都府のおススメ店舗です&#9733;</h3>
  <table>
    <tr>
      <th class="border px-2 py-2 text-center text-sm">店舗名</th>
      <th class="border px-2 py-2 text-center text-sm">店舗住所</th>
    </tr>
    @foreach($restaurants as $restaurant)
    <tr>
      <th class="border px-2 py-2 text-sm">{{ $restaurant['name'] }}</th>
      <td class="border px-2 py-2 text-sm">{{ $restaurant['address'] }}</td>
    </tr> 
    @endforeach
  </table>
</div>
@endsection
