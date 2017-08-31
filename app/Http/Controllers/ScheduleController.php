<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Schedule;
use Session;
use App\Model\Song;
use App\Model\SongDetail;
use App\Model\Pivot;
use App\Model\Category;
use App\User;

use Auth;


class ScheduleController extends Controller
{
    protected $user;

    public function __construct(){
        $this->middleware('auth')->except('getCronjobAddSchedule');
        $this->middleware(function($request,$next){
            $this->user = User::find(Auth::id());
            $this->user->setDefaultPreferences();
            $this->message = (Session::get('message'));
            return $next($request);
        })->except('getCronjobAddSchedule');
    }

    public function getCronjobAddSchedule(){
        $category =  Category::find(1);
        $latestSchedule = Schedule::getLatestSchedule($category);

        foreach(Category::all() as $category){
            // debug($category->name);
            $schedule = new Schedule();
            date_default_timezone_set('Asia/Jakarta');
            $schedule->due = date('Y-m-d  H:i:s', strtotime("+7 day", strtotime($latestSchedule->due)));

            $schedule->getCategory()->associate($category);
            $schedule->save();
        }

        // $event = new App\Model\Event();
        // $event->detail = "System added new schedule for " . dateTimeToString(Schedule::getLatestSchedule($category)->due);

        saveEvent("System added new schedule for KAP and Pelajar for " . dateTimeToString(Schedule::getLatestSchedule($category)->due),null);
    }



    public function deleteScheduleSongDetail(Request $request){
        $post = (object)$request->all();
        $schedule = Schedule::find($post->schedule_id);
        $schedule->getSongDetail()->detach($post->song_detail_id);
        $songDetail = SongDetail::find($post->song_detail_id);
        Session::flash('message.success','deleted');
        saveEvent("remove {$songDetail->title} from the schedule");
        return redirect()->back();
    }



    public function getAllSong($id){

        $data['title'] = "Schedule all song | ".TITLE;
        $data['user'] = $this->user;
        $data['schedule'] = Schedule::find($id);
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');


        return view('schedule.allSong',$data);
    }
    public function getScheduleHistory(){


            $data['title'] = "Schedule History | ". TITLE;
            $data['user'] = $this->user;


            $data['success'] = Session::get('message.success');
            $data['danger'] = Session::get('message.danger');
            $data['categories'] = Category::all();
            return view('schedule.allSchedule',$data);
    }
    //add Schedule
    public function postAddSchedule(Request $request){
        $request->flash();
        $this->validate($request,
            array('due' =>'date_format:m/d/Y')
        );

        $latestSchedule = Schedule::getLatestSchedule($this->user->getCategory);
        if(!$latestSchedule->isExpired()){
            Session::flash('message.danger',"Add schedule failed. Latest schedule is not expired yet");
            return redirect()->back();
        }
        $schedule = new Schedule($request->all());
        // debug($schedule->due);
        $schedule->due = getDefaultDatetime($schedule->due);
        // debug($schedule->due);
        $schedule->getCategory()->associate($user->getCategory);
        $schedule->save();

        Session::flash('message.success',"Schedule added");
        saveEvent("Added <b>new schedule</b> for ". dateTimeToString($latestSchedule->due));
        return redirect()->back();

    }

    //add schedule song detail
    public function postAddScheduleSongDetail(Request $request){
        $post = $request->all();
        $latestSchedule = Schedule::getLatestSchedule($this->user->getCategory);

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
        if(isset($post['id'])){
            foreach($post['id'] as $id){
                $array[$id] = $i++;
            }
        }

        $latest = Schedule::getLatestSchedule();
        foreach($latest->getSongDetail()->get() as $songDetail){
            $id = $songDetail->pivot->id;
            $songDetail->pivot->order = $array[$id];
            $songDetail->pivot->save();
        }
        saveEvent('Change song order in latest schedule');
        Session::flash('message.success','Songs has been re-ordered');
        return redirect()->back();
    }

    public function postSetWorshipLeader(Request $request){

        $post = (object)$request->all();
        // debug($post);
        $user = User::find($post->userId);
        $schedule = Schedule::find($post->scheduleId);
        $schedule->getWorshipLeader()->associate($user)->save();
        saveEvent('Set the songleader');

        Session::flash('message.success','Worship Leader set!');
        return redirect()->back();
    }

}
