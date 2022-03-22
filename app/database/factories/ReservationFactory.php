<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'name' => 'テスト5',
        'address' =>'eee@gmail.com',
        'telnum' => '08098765678',
        'remarks' => '新規テスト',
        'time' => '2022/04/01',
        'backtime' => '11:00', 
        'category' =>'KOUCH',
        'categoryname' => '企業', 
        'order' => '限定メニュー', 
        'image' => '',
        'price' => '880+',
        'sumprice' => '880',
        'status' => 1
    ];
});
