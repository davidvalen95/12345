<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Alpet extends Model
{
    //

    protected $table = "alpet";
    protected $fillable = ['verse','month','day'];
}
