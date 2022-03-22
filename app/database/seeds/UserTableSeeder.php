<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = [
            [
                'name' => 'ユーザー１',
                'email' => 'user1@test.com',
                'password' => 'aaaaaaaa',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('users')->insert($data);
    }
}
