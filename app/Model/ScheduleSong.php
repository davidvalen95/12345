<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ScheduleSong extends Model
{
    protected $table = "schedule_song";
    protected $fillable = array("song_id","schedule_id");

}
