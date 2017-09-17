<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Alpet;
use App\Helper\Classes\CBible;
use App\Helper\Classes\CAlpetVerse;
use App\User;
use Auth;
use Session;
class AlpetController extends Controller
{
    //

    private $user;
    private $message;
    public function __construct()
    {


        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
                $this->user = User::find(Auth::id());
                $this->user->setDefaultPreferences();
                $this->message = (Session::get('message'));
                return $next($request);
            });
        //


    }



    public function getAlpet($day=null, $month=null){
        //get today

        $data['title']      = 'Home | '.TITLE;
        $data['user']       = $this->user;

        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        $alpetVerses = null;

        if(!$day || !$month){
            $now =  getDefaultDatetime();
            $day =  dateTimeToString($now,"j"); //day without zeros
            $month = dateTimeToString($now,"n"); //without zeros
        }


        $alpet = Alpet::where('day',$day)->where('month',$month)->first();
        if($alpet){
            $sections = explode(",", $alpet->verse);
            $alpetVerses = [];

            foreach($sections as $section){
                $alpetVerses[] = new CAlpetVerse($section);
            }
            // return response()->json($alpetVerses);
            $data['alpetVerses'] = $alpetVerses;
            $data['sections'] = $alpet->verse;
            return view('alpet.daily',$data);

        }else{

        }





        return "$day/$month";
    }



}
