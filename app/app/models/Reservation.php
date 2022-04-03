<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    protected $fillable = ['name', 'address', 'telnum', 'remarks','order', 'price', 'sumprice', 'category', 'categoryname', 'time', 'backtime',];
    protected $table = 'Reservation';

    public function daySumAmount()
    {
      return DB::table('reservations')
              ->selectRaw('DATE_FORMAT(time, "%Y%m%d") AS time')//DATE_FORMAT(time, "%Y%m%d")で2022-03-07 12:34:32を20220307に変換。これをしないと日付が一致していても時間が12時と14時で異なると別のグループと判別されてしまうから
              ->selectRaw('SUM(sumprice) AS day_sum_amount') 
              ->selectRaw('COUNT(sumprice) AS day_sum_cuont')        
              ->groupBy('time')
              ->where('status',1)    
              ->whereIn('category', ['KOUCH','コラボ'])
              ->where(function ($query) {
                if ($search = request('search')) {
                    $query->where('time', 'LIKE', "%{$search}%")
                    ;
                   }
              })
              ->simplePaginate(5);
    }

    public function dayAveAmount()
    {
      return DB::table('reservations')
              ->selectRaw('DATE_FORMAT(time, "%Y%m%d") AS time')
              ->selectRaw('AVG(sumprice) AS day_ave_amount') 
              ->selectRaw('COUNT(sumprice) AS day_ave_cuont')        
              ->groupBy('time')
              ->where('status',1)    
              ->whereIn('category', ['KOUCH','コラボ'])
              ->where(function ($query) {
                if ($search = request('search')) {
                    $query->where('time', 'LIKE', "%{$search}%")
                    ;
                   }
              })
              ->simplePaginate(5);
    }

    public function monthSumAmount()
    {
      return DB::table('reservations')
              ->selectRaw('DATE_FORMAT(time, "%Y/%m") AS date')
              ->selectRaw('SUM(sumprice) AS month_sum_amount') 
              ->selectRaw('COUNT(sumprice) AS month_sum_cuont') 
              ->where('status',1)    
              ->whereIn('category', ['KOUCH','コラボ'])
              ->groupBy('date')
              ->where(function ($query) {
                if ($search = request('search')) {
                    $query->where('time', 'LIKE', "%{$search}%")
                    ;
                   }
              })
              ->simplePaginate(5);
    }

    public function monthAveAmount()
    {
      return DB::table('reservations')
              ->selectRaw('DATE_FORMAT(time, "%Y/%m") AS date')
              ->selectRaw('AVG(sumprice) AS month_ave_amount') 
              ->selectRaw('COUNT(sumprice) AS month_ave_cuont') 
              ->where('status',1)    
              ->whereIn('category', ['KOUCH','コラボ'])
              ->groupBy('date')
              ->where(function ($query) {
                if ($search = request('search')) {
                    $query->where('time', 'LIKE', "%{$search}%")
                    ;
                   }
              })
              ->simplePaginate(5);
    }
}
