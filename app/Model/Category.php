<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = array('id','name');

    public function setDefaultPreferences(){
        $this->name = ucwords($this->name);
        return $this;
    }

    public function getImageLogo(){
        if($this->name=="pelajar")
            return IMAGE_LOGO;
        else if ($this->name=="kap")
            return IMAGE_LOGO_KAP;
    }

    public function getUsers(){
        return $this->hasMany('App\User','category_id');
    }


    public function getSchedules(){
        return $this->hasMany('App\Model\Schedule','category_id');
    }
}
