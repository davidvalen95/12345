<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function getUsers(){
        return $this->hasMany('App\User','category_id');
    }
}
