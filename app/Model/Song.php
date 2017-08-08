<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $primaryKey   = "id";
    protected $table        = 'song';
    protected $fillable     = array('title','lyric', 'imageUrl', 'raw_lyric');



    public function setDefaultPreferences(){
        $this->title = getNameFormat($this->title);
        $this->lyric = ucwords(strtolower($this->lyric));
        //# replace uppercase after - > " [ ] “
        $this->lyric = preg_replace_callback('/([->"\]\[“])(\w+)/', create_function('$m','return $m[1].ucfirst($m[2]);'), $this->lyric);

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
        //#split 1 1
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
    public function prepareFormat(){
        $this->title = getNameFormat($this->title);//lower,trim spaces
        $this->title = preg_replace("/[^a-zA-Z\s]/","",$this->title);

    }
    public function save(array $options = array()){

        parent::save($options);

        

    }
}
