<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
class Schedule extends Model
{
    protected $table = "schedule";
    protected $fillable = array("due");

    public function getSong(){
        return $this->belongsToMany('App\Model\Song','schedule_song','schedule_id','song_id');

    }


    public function isExpired(){

        if( (time() - strtotime($this->due)) > 0){

            return true;
        }else{
            return false;
        }
    }

    public function getSongDetail(){
        // debug();
        return $this->belongsToMany('App\Model\SongDetail','schedule_song_detail','schedule_id','song_detail_id')->withPivot(array('id','order','schedule_id','song_detail_id'));
    }

    static function getLatestSchedule(){
        return Schedule::orderBy('due','desc')->get()->first();
    }
    public function getWorshipLeader(){
        return $this->belongsTo('app\User','user_id');

    }
    public function save(array $options = array()){
        //# helper function


        parent::save($options);
    }
}
