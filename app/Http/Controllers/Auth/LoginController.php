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
            Session::flash('success',"Login succeeddedddeded.. Hey $user->name. ;);)");
            // debug();
            return redirect()->intended('/');
        }else{
            Session::flash('danger',"Email or password is not registered yet");
            return redirect()->back();
        }


        return redirect();

    }
    protected function showLoginForm(){

        $email        = Form::getEmail();
        $password     = Form::getPassword();




        $forms = array($email,$password);

        $data['title']  = "YouthGBZ";
        $data['forms']  = $forms;

        return view('auth.login',$data);
    }
}
