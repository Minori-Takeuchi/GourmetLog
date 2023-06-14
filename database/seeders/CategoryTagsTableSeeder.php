<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryTag;

class CategoryTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryTag::factory()->count(80)->create();
    }
}
