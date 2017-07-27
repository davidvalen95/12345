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
        return $this;
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

    public static function getSearchSong($str){
        $exploded = preg_split("/\\W+/", $str);
        $i=0;
        foreach($exploded as $string){
            if($i==0){
                $result = Song::orWhere('title', 'like',"%".$string."%");
            }else{
                $result = $result->orWhere('title', 'like',"%".$string."%");
            }
        }
        foreach($exploded as $string){

            $result = $result->orWhere('lyric', 'like',"%".$string."%");

        }

        return $result->paginate(2000);

    }

    public function save(array $options = array()){
        saveEvent("Created <b>new song</b>, <a href='".$this->getSongDetailUrl()."'>$this->title</a>");

        parent::save($options);
    }
}
