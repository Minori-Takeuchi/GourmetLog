<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'name' => '日本料理',
        ];
        Category::create($param);
        $param = [
            'user_id' => 2,
            'name' => 'インド料理',
        ];
        Category::create($param);
        $param = [
            'user_id' => 3,
            'name' => 'イタリアン',
        ];
        Category::create($param);
        $param = [
            'user_id' => 1,
            'name' => '中華',
        ];
        Category::create($param);
        $param = [
            'user_id' => 2,
            'name' => '寿司',
        ];
        Category::create($param);
        $param = [
            'user_id' => 3,
            'name' => '定食',
        ];
        Category::create($param);
        $param = [
            'user_id' => 1,
            'name' => '焼肉',
        ];
        Category::create($param);
        $param = [
            'user_id' => 2,
            'name' => '韓国料理',
        ];
        Category::create($param);
        $param = [
            'user_id' => 3,
            'name' => 'バー',
        ];

    }
}
