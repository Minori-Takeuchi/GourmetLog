<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
{
    $userId = Auth::id();
    $restaurants = Restaurant::where('user_id', $userId)->with(['categories'])->get();

    $formattedRestaurants = $restaurants->map(function ($restaurant) {
        return [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'review' => $restaurant->review,
            'map_url' => $restaurant->map_url,
            'comment' => $restaurant->comment,
            'categories' => $restaurant->categories->map(function ($category) {
                return [
                    'category_id' => $category->id,
                    'category_name' => $category->name,
                ];
            }),
        ];
    });

    return view('top', [
        'restaurants' => $formattedRestaurants,
    ]);
}

    public function show($id)
    {
        $restaurant = Restaurant::with(['categories'])->find($id);
        $formattedRestaurants = [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'name_katakana' => $restaurant->name_katakana,
            'review' => $restaurant->review,
            'food_picture' => $restaurant->food_picture,
            'map_url' => $restaurant->map_url,
            'tel' => $restaurant->tel,
            'comment' => $restaurant->comment,
            'categories' => $restaurant->categories->map(function ($category) {
                return [
                    'category_id' => $category->id,
                    'category_name' => $category->name
                ];
            })
        ];

        return view('detail', [
            'restaurant' => $formattedRestaurants,
        ]);
    }
}
