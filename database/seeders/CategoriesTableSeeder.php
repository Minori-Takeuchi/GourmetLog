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
            'name' => '日本料理',
        ];
        Category::create($param);
        $param = [
            'name' => 'インド料理',
        ];
        Category::create($param);
        $param = [
            'name' => 'イタリアン',
        ];
        Category::create($param);
        $param = [
            'name' => '中華',
        ];
        Category::create($param);
        $param = [
            'name' => '寿司',
        ];
        Category::create($param);
        $param = [
            'name' => '定食',
        ];
        Category::create($param);
        $param = [
            'name' => '焼肉',
        ];
        Category::create($param);
        $param = [
            'name' => '韓国料理',
        ];
        Category::create($param);
        $param = [
            'name' => 'バー',
        ];

    }
}
