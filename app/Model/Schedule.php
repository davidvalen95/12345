<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = "schedule";
    protected $fillable = array("due");

    public function getSong(){
        return $this->belongsToMany('App\Model\Song','schedule_song','schedule_id','song_id');
        
    }
}
