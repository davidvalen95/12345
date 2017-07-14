<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','instrument', 'category',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setDefaultPreferences(){
        $this->name = ucwords($this->name);
        $this->instrument = ucwords($this->instrument);
    }

    public function getImageLogo(){
        switch($this->category_id){
            case 1: return IMAGE_LOGO;
            case 2: return IMAGE_LOGO_KAP;
            default: return IMAGE_LOGO;
        }

    }
}
