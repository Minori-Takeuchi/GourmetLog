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

        return view('restaurant/top', [
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

        return view('restaurant/detail', [
            'restaurant' => $formattedRestaurants,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $userId = Auth::id();

        $restaurants = Restaurant::where('user_id', $userId)->with(['categories']);

        if (!empty($search)) {
            $restaurants->where('name', 'LIKE', "%{$search}%");
        }

         $restaurants = $restaurants->get();

        $formattedRestaurants = $restaurants->map(function ($restaurant) {
            return [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'review' => $restaurant->review,
                'map_url' => $restaurant->map_url,
                'comment' => $restaurant->comment,
                'categories' => $restaurant->categories->map(function ($category) {
                    return [
                        'category_name' => $category->name,
                    ];
                }),
            ];
        });

        return view('restaurant/top', [
            'restaurants' => $formattedRestaurants,
        ]);
    }

    public function edit($id)
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

        return view('restaurant/form', [
            'restaurant' => $formattedRestaurants,
        ]);
    }

    public function form()
    {
        return view('restaurant/form');
    }
}
