<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = ['name', 'address', 'telnum', 'remarks'];
    protected $table = 'Info';
}
