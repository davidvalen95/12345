<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Helper\Form;
use App\Model\Song;
class SongController extends Controller
{
    private $user;
    public function __construct(){
        $this->middleware(function($request,$next){
            $this->user = User::find(Auth::id());
            $this->user->setDefaultPreferences();
            return $next($request);
        });
    }



    public function index(){
        $data['title'] = 'Home | '.TITLE;
        $data['user'] = $this->user;
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

        return view('song.newSong',$data);
    }

    public function postNewSong(Request $request){
        $request->flash();
        $this->validate($request,array(
            'title' => "required|unique:song",
            'lyric' => 'required'

        ));



        $song = new Song($request->all());
        $song->save();


        $urlSong = getUrlFormat($song->title);
        return redirect("song/$urlSong/$song->id");
    }

    public function getSongDetail($title, $id){
        $song = Song::find($id);
        if(!$song){
            return redirect('/');
        }
        $song->setDefaultPreferences();
        $data['title']  = "$song->title | ". TITLE;
        $data['user']   = $this->user;
        $data['song']   = $song;
        return view('song.songDetail',$data);
    }
}
