<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Helper\Form;
use App\User;
use Auth;
use App\Model\Schedule;
use App\Model\Song;
use App\Model\Event;
use App\Model\Category;
use Session;
use Illuminate\Support\Facades\Mail;;

class EmailController extends Controller
{
    private $user;
    private $message;
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            if(Auth::check()){
                $this->user = User::find(Auth::id());
                $this->user->setDefaultPreferences();
                $this->message = (Session::get('message'));
                if($this->user->email == "davidvalen95@gmail.com"){
                    return $next($request);

                }
            }
            return redirect()->back();

        });

                //

    }

    public function getEmailDraft(){


        $data = [];
        $data['title'] = "Email | " . TITLE;
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        $data['user']  = $this->user;

        return view('email.draft', $data);
    }
    public function postEmailDraft(Request $request){
        $post = (object) $request->all();

        $textMessage = $post->textMessage;
        $textMessage = str_replace("{{name}}", $this->user->name , $textMessage);
        // debug($textMessage);
        $users = User::all();
        foreach ($users as $user) {

            Mail::send([], [], function ($message)  use ($post,$textMessage){
                $message->from('reminder@gbzworshipper.com', "Youth GBZ");
                $message->subject($post->subject);
                $message->to($user->email);
                $message->setBody($textMessage, 'text/html');
            });

        }



        $request->session()->flash('message.success',"Message sent!");
        return redirect()->back();
    }


}
