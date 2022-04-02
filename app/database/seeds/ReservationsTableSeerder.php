<?php

use Illuminate\Database\Seeder;
use APP\models\Reservation;

class ReservationsTableSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservations')->insert([
            'name' => 'テスト',
            'address' =>'埼玉',
            'telnum' => '07087976545',
            'remarks' => '特になし',
            'time' => '2022-03-21',
            'backtime' => '13:00-13:30', 
            'category' =>'KOUCH',
            'categoryname' => '企業', 
            'order' => 'ステーキ　生姜焼き 肉じゃが', 
            'image' => '',
            'price' => '680+680+680+',
            'sumprice' => '2040',
            'status' => 1
        ]);

        DB::table('reservations')->insert([
            'name' => 'テスト2',
            'address' =>'東京',
            'telnum' => '09034529876',
            'remarks' => '特になし',
            'time' => '2022-07-22',
            'backtime' => '13:00', 
            'category' =>'KOUCH',
            'categoryname' => '企業', 
            'order' => 'ステーキ　生姜焼き', 
            'image' => '',
            'price' => '680+680',
            'sumprice' => '1360',
            'status' => 1
        ]);

        DB::table('reservations')->insert([
            'name' => 'テスト3',
            'address' =>'神奈川',
            'telnum' => '08078987653',
            'remarks' => 'あり',
            'time' => '2022-06-23',
            'backtime' => '13:30', 
            'category' =>'コラボ',
            'categoryname' => '民家', 
            'order' => 'ステーキ', 
            'image' => '',
            'price' => '680+',
            'sumprice' => '680',
            'status' => 1
        ]);

        DB::table('reservations')->insert([
            'name' => 'テスト4',
            'address' =>'千葉',
            'telnum' => '07087976545',
            'remarks' => '特になし',
            'time' => '2022-05-21',
            'backtime' => '13:00-13:30', 
            'category' =>'KOUCH',
            'categoryname' => '企業', 
            'order' => 'ステーキ　生姜焼き 肉じゃが', 
            'image' => '',
            'price' => '680+680+680+',
            'sumprice' => '2040',
            'status' => 1
        ]);

        DB::table('reservations')->insert([
            'name' => 'テスト5',
            'address' =>'茨城',
            'telnum' => '09034529876',
            'remarks' => '特になし',
            'time' => '2022-03-21',
            'backtime' => '13:00', 
            'category' =>'KOUCH',
            'categoryname' => '企業', 
            'order' => 'ステーキ　生姜焼き', 
            'image' => '',
            'price' => '680+680',
            'sumprice' => '1360',
            'status' => 1
        ]);
        
        DB::table('reservations')->insert([
            'name' => 'テスト6',
            'address' =>'群馬',
            'telnum' => '08078987653',
            'remarks' => 'あり',
            'time' => '2022-04-23',
            'backtime' => '13:30', 
            'category' =>'コラボ',
            'categoryname' => '民家', 
            'order' => 'ステーキ', 
            'image' => '',
            'price' => '680+',
            'sumprice' => '680',
            'status' => 1
        ]);

        DB::table('reservations')->insert([
            'name' => 'テスト7',
            'address' =>'群馬',
            'telnum' => '08078987653',
            'remarks' => 'あり',
            'time' => '2022-08-23',
            'backtime' => '13:30', 
            'category' =>'コラボ',
            'categoryname' => '民家', 
            'order' => 'ステーキ', 
            'image' => '',
            'price' => '680+',
            'sumprice' => '680',
            'status' => 1
        ]);
    }
}
