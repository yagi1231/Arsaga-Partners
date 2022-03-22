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
            'address' =>'aaa@gmail.com',
            'telnum' => '07087976545',
            'remarks' => '特になし',
            'time' => '2022/03/21',
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
            'address' =>'bbb@gmail.com',
            'telnum' => '09034529876',
            'remarks' => '特になし',
            'time' => '2022/03/22',
            'backtime' => '13:00', 
            'category' =>'大戸屋',
            'categoryname' => '企業', 
            'order' => 'ステーキ　生姜焼き', 
            'image' => '',
            'price' => '680+680',
            'sumprice' => '1360',
            'status' => 1
        ]);
        DB::table('reservations')->insert([
            'name' => 'テスト3',
            'address' =>'ccc@gmail.com',
            'telnum' => '08078987653',
            'remarks' => 'あり',
            'time' => '2022/03/23',
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
