<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'ゲスト',
            'email' => 'gest@gest.com',
            'password' => bcrypt('password')
        ];
        User::create($param);
        $param = [
            'name' => 'ゲスト2',
            'email' => 'gest2@gest.com',
            'password' => bcrypt('password')
        ];
        User::create($param);
        $param = [
            'name' => 'ゲスト3',
            'email' => 'gest3@gest.com',
            'password' => bcrypt('password')
        ];
        User::create($param);
    }
}
