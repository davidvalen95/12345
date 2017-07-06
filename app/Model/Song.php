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
        $this->lyric = ucwords(strtolower($this->lyric));
    }

    public function getSongDetail(){
        return $this->hasMany('App\Model\SongDetail');
    }

    public function getSchedule(){
        return $this->belongsToMany('App\Model\Schedule','schedule_song', 'song_id', 'schedule_id');
    }

    public function getSongDetailUrl(){
        return action("SongController@getSongDetail",array(getUrlFormat($this->title), $this->id));
    }
}
