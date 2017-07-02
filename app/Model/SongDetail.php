<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SongDetail extends Model
{

    protected $fillable = array("song_id","user_id","title","embedUrl","description");


    protected $table = "song_detail";


    public function getSong(){
        return $this->belongsTo('App\Model\Song','song_id');
    }

    public function getUser(){
        return $this->belongsTo('App\User','user_id');
    }

}
