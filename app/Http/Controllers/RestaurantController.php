<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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

        // マップ表示
        if($restaurant->map_url) {
            $decodedUrl = urldecode($restaurant->map_url);
            $placeUrl = parse_url($decodedUrl, PHP_URL_PATH);
            $queryString = parse_url($decodedUrl, PHP_URL_QUERY);
            parse_str($queryString, $queryParams);
            $address = $queryParams['q'] ?? '';
            $convertedUrl = 'https://maps.google.co.jp/maps?q=' . $address . '&output=embed&t=m';
        } else {
            $convertedUrl = null;
        }
        $formattedRestaurants = [
            'id' => $restaurant->id,
            'name' => $restaurant->name,
            'name_katakana' => $restaurant->name_katakana,
            'review' => $restaurant->review,
            'food_picture' => $restaurant->food_picture,
            'map_url' => $convertedUrl,
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

    // 編集画面表示
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
        // マップ表示
        if($request->map_url) {
            $decodedUrl = urldecode($request->map_url);
            $placeUrl = parse_url($decodedUrl, PHP_URL_PATH);
            $queryString = parse_url($decodedUrl, PHP_URL_QUERY);
            parse_str($queryString, $queryParams);
            $address = $queryParams['q'] ?? '';
            $convertedUrl = 'https://maps.google.co.jp/maps?q=' . $address . '&output=embed&t=m';
        } else {
            $convertedUrl = null;
        }

        // 画像を仮ストレージへ保存
        if ($request->hasFile('food_picture')) {
            $file = $request->file('food_picture');
            $temporaryImagePath = $file->store('temporary');
            $foodPictureTempPath = asset($temporaryImagePath);
        } else {
            $foodPictureTempPath = null;
        }

        $restaurant = [
            'id' => $request->id,
            'name' => $request->name,
            'name_katakana' => $request->name_katakana,
            'review' => $request->review ? $request->review : null,
            'food_picture' => $foodPictureTempPath,
            'map_url' => $convertedUrl,
            'tel' => $request->tel ? $request->tel : null,
            'comment' => $request->comment,
        ];
        

        $categories = $request->input('category_ids', []);
        $categoryData = Category::whereIn('id', $categories)->get();

        return view('restaurant.confirm', [
            'restaurant' => $restaurant,
            'categories' => $categoryData
        ]);
    }

    // 新規作成または更新
    public function upsert(Request $request)
    {   
        if($request->input('back') == 'back') {
            return redirect('/restaurant/form')->withInput();
        }

        $id = $request->input('id');

        // 画像のパスを変更する
        $url = $request->food_picture;
        $appUrl = env('APP_URL');
        $newUrl = str_replace($appUrl . '/temporary/', $appUrl . '/image/', $url);
        $strageUrl = str_replace($appUrl , '', $url);
        $newStrageUrl = str_replace($appUrl , '', $newUrl);
        $oldPath = public_path($strageUrl);
        $newPath = public_path($newStrageUrl);
        File::move($oldPath, $newPath);
        File::delete(public_path($oldPath));


        $restaurantData = [
            'name' => $request->input('name'),
            'name_katakana' => $request->input('name_katakana'),
            'review' => $request->input('review'),  
            'map_url' => $request->input('map_url'),
            'food_picture' => $newUrl,
            'tel' => $request->input('tel'), 
            'comment' => $request->input('comment'), 
        ];


        // idが存在する場合はアップデート、存在しない場合は新規作成
        $categoryIds = $request->input('category_ids');
        if ($id) {
            $restaurant = Restaurant::find($id);
            if ($restaurant) {
                $restaurant->update($restaurantData);
                $restaurant->categories()->sync($categoryIds);
            }
        } else {
            $restaurant = Restaurant::create($restaurantData);
            $restaurant->categories()->attach($categoryIds);
        }

        return redirect()->route('top');
    }

    // 店舗情報削除
    public function delete($id)
    {
        Restaurant::find($id)->delete();
        return back();
    }

}
