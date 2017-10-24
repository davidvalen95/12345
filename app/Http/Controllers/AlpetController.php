<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Alpet;
use App\Helper\Classes\CBible;
use App\Helper\Classes\CAlpetVerse;
use App\User;
use Auth;
use Session;

use App\Model\FavoriteVerse;
use DOMDocument;
class AlpetController extends Controller
{
    //

    private $user;
    private $message;
    public function __construct()
    {

                $this->middleware(['auth'])->only(['postFavorite','getFavorite']);

                $this->middleware(function ($request, $next) {
                    if(Auth::check()){
                            $this->user = User::find(Auth::id());
                            $this->user->setDefaultPreferences();
                            $this->message = (Session::get('message'));

                        }
                    else{
                        $this->user = null;
                    }
                    return $next($request);
                    });

                //

    }



    public function getAlpet($version=null, $day=null, $month=null){
        //get today
        if(!$version || is_numeric($version)){
            $now =  getDefaultDatetime();
            $version = "tb";
            return redirect()->route('get.alpet',[$version]);

        }
        if(!$day || !$month){
            $now =  getDefaultDatetime("");
            $day =  dateTimeToString($now,"j"); //day without zeros
            $month = dateTimeToString($now,"n"); //without zeros
            return redirect()->route('get.alpet',[$version,$day,$month]);

        }

        $data['title']      = "Alpet $day-$month | " .TITLE;
        $data['user']       = $this->user;
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');

        $alpetVerses = null;

        $alpet = Alpet::where('day',$day)->where('month',$month)->first();
        if($alpet){//#$alpet
            // $sections = explode(",", $alpet->verse);
            // $sections = $this->getSections();;
            $sections = explode(",",$alpet->verse);
            $alpetVerses = [];

            foreach($sections as $section){
                $alpetVerses[] = new CAlpetVerse($version, $section);
            }
            // return response()->json($alpetVerses);
            $data['alpetVerses'] = $alpetVerses;
            $data['version'] = $version;
            $data['day'] = $day;
            $data['month'] = $month;
            // $data['sections'] = "{$sections[0]}, {$sections[1]}";//#$alpet->verse
            $data['sections'] = $alpet->verse;
            $favorites = [];
            if(Auth::check()){
                $favorites = $this->user->getFavorites;
            }
            $data['favorites'] = $favorites;
            $data['tags'] = $this->user->getFavorites()->distinct()->get(['comment']);

            // return response()->json($data['tags']);
            // debug(((array)$favorites));
            return view('alpet.daily',$data);

        }else{

        }


        return "$version/$day/$month";



    }
    public function getFavorite(Request $request){
        $data['title']      = "Favorite Verse | " .TITLE;
        $data['user']       = $this->user;
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');

        $favorites = $this->user->getFavorites()->orderBy('comment','asc')->orderBy('created_at','desc')->get();

        //# grouped based on comment
        $groupedFavorites = [];
        $previousComment = "";
        foreach($favorites as $favorite){
            if($favorite->comment != $previousComment){
                $groupedFavorites[$favorite->comment] = [];
            }
            $previousComment = $favorite->comment;
            $groupedFavorites[$favorite->comment][] = $favorite;
        }

        $data['groupedFavorites'] = $groupedFavorites;
        // return response()->json($groupedFavorites);;
        return view('alpet.favoriteVerse', $data);
    }
    public function postFavorite(Request $request){

        $post = (object) $request->all();
        $favorite = new FavoriteVerse($request->all());
        $favorite->getUser()->associate($this->user);
        $favorite->save();


        // return response()->json($post);
    }

    private function getSections(){
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, "http://www.tulang-elisa.org/khotbah/wahyu/");
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $httpText = curl_exec($curlSession);
        curl_close($curlSession);
        $node = new DOMDocument();
        libxml_use_internal_errors(true);
        $node->loadHTML($httpText);
        libxml_use_internal_errors(false);
        // debug($node);
        $pembacaanNode = $node->getElementById("Pembacaan");
        $pembacaanNode->getElementsByTagName("p");
        $raw = $pembacaanNode->childNodes->item(3)->textContent;
        $raw = preg_replace("/\s/", "", $raw);
        // debug($raw);
        $regex = 'WasiatLama\(Perj\.Lama\):(.*)WasiatBaru\(Perj\.Baru\):(.*)';
        // $regex2 = "(\w*)";
        preg_match_all("/$regex/", $raw, $groupMatches);

        //# WB WL
        return [$groupMatches[2][0], $groupMatches[1][0]];
        // debug($groupMatches);

        // return response()->json($pembacaanNode);
    }


}
