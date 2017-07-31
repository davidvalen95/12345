<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Helper\Form;
use App\Model\Song;
use App\Model\SongDetail;
use App\Model\Schedule;
use Session;
class SongController extends Controller
{
    private $user;
    private $message;
    public function __construct(){
        $this->middleware(function($request,$next){
            // debug(Auth::id());
            $this->user = User::find(Auth::id());
            $this->user->setDefaultPreferences();
            $this->message = (Session::get('message'));
            return $next($request);
        });

        $this->middleware('auth');
    }



    public function index(){
        $data['title'] = 'Home | '.TITLE;
        $data['user'] = $this->user;



        // Session::forget('message');
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        return view('',$data);
    }

    public function getNewSong(){
        $data['title'] = 'Home | '.TITLE;
        $data['user'] = $this->user;

        //placeholder, name, type, icon, options:array
        $title = new Form('Song Title','title','text',"");
        // $verse = new Form('Verse(bait)','bait','textarea',"");
        $lyric = new Form('Lyric','lyric','editor',"");
        $foto = new Form('Url Image Cover (ex. https://pbs.twimg.com/profile_images/710468502457442304/f-8UB2T1.jpg)', 'imageUrl', 'text', "");
        $data['forms'] = array($title, $foto, $lyric);

        // Session::forget('message');
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        return view('song.newSong',$data);
    }


    public function getSongDetail($title, $id, Request $request){
        $song = Song::find($id);
        if(!$song){
            return redirect('/');
        }
        $song->setDefaultPreferences();
        $data['title']  = "$song->title | ". TITLE;
        $data['user']   = $this->user;
        $data['song']   = $song;
        $data['songDetails'] = $song->getSongDetail;;

        //#form
        //placeholder, name, type, icon, options:array
        // $titleForm          = new Form("Video title", "title", "text", "");
        $urlForm            = new Form("Video code*", "embedUrl", "text","");
        $descriptionForm    = new Form("Video description", "description", "text", "");
        $songId             = new Form("song id", "song_id", "hidden", "", [], "$song->id");
        $data['forms'] =  array( $urlForm,$descriptionForm,$songId);
        $schedule  = Schedule::getLatestSchedule();
        // debug($schedule->due);

        //# cek lagu uda di add
        $isUsed = false;
        foreach( $schedule->getSongDetail as $songDetail){
            $checkSong = $songDetail->getSong;
            if($checkSong->id == $id){
                $isUsed = true;
                $data['usedSong'] = $songDetail;
                break;
            }
        }

        $data['isUsed'] = $isUsed;



        // // Session::forget('message');
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        return view('song.songDetail',$data);

    }



    public function postNewSong(Request $request){
        $request->flash();
        $this->validate($request,array(
            'title' => "required|unique:song",
            'lyric' => 'required'

        ));



        $song = new Song($request->all());
        $song->user_id = $this->user->id;
        $song->save();


        $urlSong = getUrlFormat($song->title);
        $request->session()->flash('message.success', "New song created");
        return redirect("song/$urlSong/$song->id");
    }


    public function postSongDetail(Request $request){

        $post = (object)$request->all();
        $request->flash();
        $this->validate($request, array(
            // 'title' => 'required',
            // 'description' => 'required',
            'embedUrl'  => 'unique:song_detail'

        ));


        $songDetail = new SongDetail($request->all());

        $songDetail->user_id = Auth::id();
        // debug(Auth::id());
        //# sdah ada songId dari form
        $fileContent = file_get_contents("http://youtube.com/get_video_info?video_id=".$post->embedUrl);
        parse_str($fileContent, $content);
        $content = (object)$content;
        if($content->status == "fail"){
            $request->session()->flash('message.danger', "$content->reason");
            return redirect()->back();

        }
        $songDetail->title = $content->title;
        $songDetail->save();


        $request->session()->flash('message.success', "Video arangement submited!");

        return redirect()->back();
    }



}
