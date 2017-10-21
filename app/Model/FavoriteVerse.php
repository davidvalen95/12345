<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FavoriteVerse extends Model
{
    //
    protected $table = "favorite_verse";
    protected $fillable = ['content','user_id','comment', 'verse'];


    public function getUser(){
        return $this->belongsTo('App\User','user_id');
    }

    public function isContain($currentVerse){
        
    }
}
