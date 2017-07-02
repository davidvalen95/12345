<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $primaryKey   = "id";
    protected $table        = 'song';
    protected $fillable     = array('title','lyric', 'imageUrl');



    public function setDefaultPreferences(){
        $this->title = getNameFormat($this->title);
    }

    public function getSongDetail(){
        return $this->hasMany('App\Model\SongDetail');
    }
}
