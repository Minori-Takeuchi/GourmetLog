<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // トップ画面店舗一覧表示
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

    // 店舗詳細画面表示
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

    // トップ画面検索
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

    // 編集画面へ
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
        ];

        $restaurantCategories = $restaurant->categories->pluck('id');
        $restaurantCategoriesData = Category::whereIn('id', $restaurantCategories)->get();

        $categories = Category::all();

        return view('restaurant/form', [
            'restaurant' => $formattedRestaurants,
            'restaurant_categories' => $restaurantCategoriesData,
            'categories' => $categories
        ]);
    }

    // 店舗新規作成画面表示
    public function form()
    {
        $categories = Category::all();
        return view('restaurant/form',[
            'categories' => $categories
        ]);
    }

    // 確認画面表示
    public function confirm(Request $request)
    {
        $decodedUrl = urldecode($request->map_url);
        $placeUrl = parse_url($decodedUrl, PHP_URL_PATH);
        $queryString = parse_url($decodedUrl, PHP_URL_QUERY);
        parse_str($queryString, $queryParams);
        $address = $queryParams['q'] ?? '';

        $convertedUrl = 'https://maps.google.co.jp/maps?q=' . $address . '&output=embed&t=m';

        $restaurant = [
            'id' => $request->id,
            'name' => $request->name,
            'name_katakana' => $request->name_katakana,
            'review' => $request->review,
            'food_picture' => $request->food_picture,
            'map_url' => $convertedUrl,
            'tel' => $request->tel,
            'comment' => $request->comment,
        ];
        $categories = $request->input('categories', []);
        $categoryData = Category::whereIn('id', $categories)->get();

        return view('restaurant.confirm', [
            'restaurant' => $restaurant,
            'categories' => $categoryData
        ]);
    }
}
