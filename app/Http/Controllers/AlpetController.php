<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Alpet;
class AlpetController extends Controller
{
    //

    public function __contrsuct(){
        // parent::__construct();
    }





    public function getAlpet($day=null, $month=null){
        //get today
        if(!$day || !$month){
            $now =  getDefaultDatetime();
            $day =  dateTimeToString($now,"j"); //day without zeros
            $month = dateTimeToString($now,"n"); //without zeros
        }


        $alpet = Alpet::where('day',$day)->where('month',$month)->first();

        $verses = explode(",", $alpet->verse);
        debug($verses);




        return "$day/$month";
    }



}



class AlpetVerse{
    public $canon;
    public $from;
    public $until;

    public __construct($fullReference){
        $fullReference = $this->sanitize($fullReference);

    }


    private sanitize($str){


        
        return $str;
    }
}
