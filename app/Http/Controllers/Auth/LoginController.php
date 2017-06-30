<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Helper\Form;
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

    protected function showLoginForm(){
        $name         = new Form("Full Name","name","text","glyphicon-user");
        $email        = new Form("Email","email","email","glyphicon-envelope");
        $optionMusik  = array(
        "gitar"=>"Gitar",
        "drum"=>"Drum",
        "bass" => "Bass",
        "keyboard" => "Keyboard"
        );
        $instrument   = new Form("Instrument", "instrument", "select", "glyphicon-music",  $optionMusik);
        $password     = new Form("Password","passwd","password","glyphicon-lock");
        $passwordR    = new Form("Retype password","retype","password","glyphicon-lock");

        $registCode   = new Form("Registration Code","registrationCode","text","glyphicon-tag");



        $forms = array($name, $email, $instrument, $password, $passwordR, $registCode);

        $data['title']  = "YouthGBZ";
        $data['forms']  = $forms;

        return view('auth.register',$data);
    }
}
