<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Form;
use App\User;
use Auth;
use App\Model\Schedule;
use App\Model\Song;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // debug(Auth::user());
        // /home
        $data['title'] = 'Home | '.TITLE;
        $data['user'] = $this->user;
        $schedule = Schedule::orderBy('due','desc')->get()->first();
        $data['schedule'] = $schedule;
        $data['songFromSchedule'] = $schedule->getSong;;
        $data['songs'] = Song::paginate(15);
        // Session::flush();



        // Session::forget('message');
        return view('home',$data);
        // return redirect('/song/sadf/3');
    }
}
