<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'Event';

    protected $fillable = array('user_id','detail');





    public function getUser(){
        return $this->belongsTo('App\User','user_id');
    }



}
