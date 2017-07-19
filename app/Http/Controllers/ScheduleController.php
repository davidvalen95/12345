<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Schedule;
use Session;
use App\Model\Song;
use App\Model\SongDetail;
use App\Model\Pivot;
use App\User;
use Auth;


class ScheduleController extends Controller
{
    protected $user;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function($request,$next){
            $this->user = User::find(Auth::id());
            $this->user->setDefaultPreferences();
            $this->message = (Session::get('message'));
            return $next($request);
        });
    }
    public function deleteScheduleSongDetail(Request $request){
        $post = (object)$request->all();
        $schedule = Schedule::find($post->schedule_id);
        $schedule->getSongDetail()->detach($post->song_detail_id);
        Session::flash('message.success','deleted');
        return redirect()->back();
    }
    public function getAllSong(){

        $data['title'] = "Schedule all song | ".TITLE;
        $data['user'] = $this->user;
        $data['schedules'] = Schedule::orderBy('due','desc')->take(3)->get();
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');


        return view('schedule.allSong',$data);
    }

    //add Schedule
    public function postAddSchedule(Request $request){
        $request->flash();
        $this->validate($request,
            array('due' =>'date_format:m/d/Y')
        );

        $latestSchedule = Schedule::orderBy('due','desc')->get()->first();
        if(!$latestSchedule->isExpired()){
            Session::flash('message.danger',"Add schedule failed. Latest schedule is not expired yet");
            return redirect()->back();
        }
        $schedule = new Schedule($request->all());
        // debug($schedule->due);
        $schedule->due = getDefaultDatetime($schedule->due);
        // debug($schedule->due);
        $schedule->save();

        Session::flash('message.success',"Schedule added");
        return redirect()->back();

    }

    //add schedule song detail
    public function postAddScheduleSongDetail(Request $request){
        $post = $request->all();
        $latestSchedule = Schedule::getLatestSchedule();

        // debug(dateTimeToString($latestSchedule->due));

        if($latestSchedule->isExpired()){
            Session::flash('message.danger','Add song failed. Latest schedule has expired. add new schedule');
            return redirect()->back();
        }

        $songDetail = SongDetail::find($post['songDetailId']);
        $latestSchedule->getSongDetail()->attach($songDetail);

        return redirect()->back()->with('message.success','Song added to the schedule');
    }


    public function postOrderSongDetail(Request $request){

        $post = $request->all();
        // debug($post);
        //# simpen urutan di array named with id
        $array = array();
        $i=0;
        foreach($post['id'] as $id){
            $array[$id] = $i++;
        }


        $latest = Schedule::getLatestSchedule();
        foreach($latest->getSongDetail()->get() as $songDetail){
            $id = $songDetail->pivot->id;
            $songDetail->pivot->order = $array[$id];
            $songDetail->pivot->save();
        }

        Session::flash('message.success','Songs has been re-ordered');
        return redirect()->back();
    }

}
