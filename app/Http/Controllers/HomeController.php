<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Form;
use App\User;
use Auth;
use App\Model\Schedule;
use App\Model\Song;
use App\Model\Event;
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
        $request->flash();
        $post = $request->all();
        if(isset($post['songSearch'])){
            // debug($post['songSearch']);
            $data['songs'] = Song::getSearchSong($post['songSearch']);

        }else{
            $data['songs'] = Song::paginate(15);
        }
        $data['title']      = 'Home | '.TITLE;
        $data['user']       = $this->user;
        $schedule           = Schedule::orderBy('due','desc')->take(3)->get();
        $data['schedules']  = $schedule;
        $data['events']     = Event::orderBy('created_at','desc')->take(15)->get();
        //placeholder, name, type, icon, options:array, $value=null

        //# dipindah ke weeklylist karena weeklylist include dimanapun
        // $data['scheduleForm']   =

        // Session::flush();

        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');

        // Session::forget('message');
        return view('home',$data);
        // return redirect('/song/sadf/3');

    }


}
