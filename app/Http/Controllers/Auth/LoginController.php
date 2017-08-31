<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Auth;
use App\Helper\Form;
use Illuminate\Http\Request;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function login(Request $request){

        $request->flash();
        $this->validate($request, array(
            'email' => Form::getEmail()->validatorSetting,
            'password' => 'required'

        ));
        if(Auth::attempt(array(
            'email' => $request['email'],
            'password' => $request['password']
        ))){
            $user = User::find(Auth::id());
            // $request->session()->flash('message.success',"Hey welcome back <b>{$user->setDefaultPreferences()->name}</b> ");
            $request->session()->flash('message.success',"Hey welcome back <b>{$user->setDefaultPreferences()->name}</b> ");
            // debug();
            return redirect()->intended('/');
        }else{
            $request->session()->flash('message.danger',"Email or password is not registered yet");
            return redirect()->back();
        }

        return redirect()->intended('/');


    }
    protected function showLoginForm(){

        $email        = Form::getEmail();
        $password     = Form::getPassword();




        $forms = array($email,$password);

        $data['title']  = "YouthGBZ";
        $data['forms']  = $forms;
        // Session::forget('message');
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        return view('auth.login',$data);
    }

    function getForgotPassword(Request $request){


        $email        = Form::getEmail();
        $password     = Form::getPassword();
        $passwordR    = new Form("Retype password","password_confirmation","password","glyphicon-lock");
        $forms = array($email,$password,$passwordR);

        $data['title']  = "YouthGBZ";
        $data['forms']  = $forms;
        $data['forgotPassword'] = "";
        // Session::forget('message');
        $data['success'] = Session::get('message.success');
        $data['danger'] = Session::get('message.danger');
        return view('auth.login',$data);
    }

    function postForgotPassword(Request $request){



        $request->flash();
        $this->validate($request,array(
            'password' => 'required|confirmed',
            'email' => 'exists:users|email|required'
        ));
        $post = (object) $request;
        $user = User::where('email','=',"$post->email")->first();
        // debug($user->);
        if($user == null){
            // debug();

            return redirect()->back()->with('message.danger',"Email is not registered yet");
        }else if($user->reset == 0 ){
            return redirect()->back()->with('message.danger',"No Permission to reset, ask admin to give permission");
        }
        $user->password = bcrypt($post->password);
        $user->reset = false;
        $user->save();

        // debug();
        $request->session()->flash('message.success',"Password changed, reset permission for user {$user->setDefaultPreferences()->name} revoked");
        return redirect(route('login'));

    }
}
