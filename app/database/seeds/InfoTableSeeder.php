<?php

use Illuminate\Database\Seeder;
use App\models\Info;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('infos')->insert([
            'name' => Str::random(10),
            'address' => Str::random(10).'@gmail.com',
            'telnum' => '07087976545',
            'remarks' => Str::random(10),
        ]);

        DB::table('infos')->insert([
            'name' => 'test',
            'address' => '埼玉',
            'telnum' => '08087654321',
            'remarks' => 'なし',
        ]);
        
        DB::table('infos')->insert([
            'name' => 'test2',
            'address' => '東京',
            'telnum' => '09098767897',
            'remarks' => 'あり',
        ]);

        DB::table('infos')->insert([
            'name' => 'test3',
            'address' => '東京',
            'telnum' => '09098767897',
            'remarks' => 'あり',
        ]);
        
        DB::table('infos')->insert([
            'name' => 'test5',
            'address' => '東京',
            'telnum' => '09098761238',
            'remarks' => 'あり',
        ]);

        DB::table('infos')->insert([
            'name' => 'test6',
            'address' => '東京',
            'telnum' => '09098761238',
            'remarks' => 'あり',
        ]);
    }
}
