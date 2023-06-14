<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HotpepperController extends Controller
{
    private const REQUEST_URL = 'http://webservice.recruit.co.jp/hotpepper/gourmet/v1/';


    private $api_key;

    public function index()
    {
        $userName = Auth::user()->name;
        $now = now();
        $date = $now->toDateString();
        $formattedDate = Carbon::parse($date)->format('n月j日');
        $message = '';
        if ($now->hour >= 6 && $now->hour < 12) {
            $message = 'おはようございます！今日のランチはもう決めましたか？';
        } elseif ($now->hour >= 12 && $now->hour < 18) {
            $message = 'こんにちは！今日のディナーはもう決めましたか？';
        } else {
            $message = 'こんばんは！明日のモーニングはもう決めましたか？';
        }
        
        $client = new Client();
        $method = 'GET';

        $this->api_key = config('hotpepper.api_key');

        $options = [
            'query' => [
                'key' => config('hotpepper.api_key'),
                'large_area' => 'Z022',
                'count' => 10,
                'sort' => 4,
                'format' => 'json',
            ],
        ];


        $response = $client->request($method, self::REQUEST_URL, $options);

        $restaurants = json_decode($response->getBody(), true)['results']['shop'];
        
        $formatRestaurants = [];
        foreach ($restaurants as $restaurant) {
            $formatRestaurants[] = [
                'name' => $restaurant['name'],
                'address' => $restaurant['address'],
            ];
        }

        return view('dashboard', [
            'user_name' => $userName,
            'date' => $formattedDate,
            'message' => $message,
            'restaurants' => $formatRestaurants
        ]);
    }
}
