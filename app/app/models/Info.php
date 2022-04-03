<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = "infos";
    
    protected $fillable = ['name', 'address', 'telnum', 'remarks'];
}
