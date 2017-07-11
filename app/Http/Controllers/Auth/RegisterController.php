<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\Helper\Form;
use Session;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function register(Request $request){

        // debug($request->all());
        $request->flash();
        $this->validate($request,array(
            'password' => 'required|confirmed',
            'category' => 'required|in:1,2',
            'instrument' => 'required',
            'name' => 'required|min:3|max:20',
            'email' => Form::getEmail()->validatorSetting.'|unique:users',
            'registrationCode' => 'required|in:hendri'


        ));

        $user = new User($request->all());
        $user->password = bcrypt($user->password);
        $user->name     = ucwords($user->name);
        $user->instrument = ucwords($user->instrument);
        // debug($user);
        $user->save();

        Session::flash('message.success', 'Register success. Go login ;)');
        return redirect('/login');
    }

    protected function showRegistrationForm(){
        $name         = new Form("Full Name","name","text","glyphicon-user");
        $email        = Form::getEmail();
        $category     = new Form("Pelajar / Kap", "category", "select", "id-card-o",  array("1"=>"Pelajar","2"=>"KAP"));
        $optionMusik  = array(
        "gitar"=>"Gitar",
        "drum"=>"Drum",
        "bass" => "Bass",
        "keyboard" => "Keyboard"
        );
        $instrument   = new Form("Instrument", "instrument", "select", "glyphicon-music",  $optionMusik);
        $password     = Form::getPassword();
        $passwordR    = new Form("Retype password","password_confirmation","password","glyphicon-lock");

        $registCode   = new Form("Registration Code","registrationCode","text","glyphicon-tag");



        $forms = array($name, $email, $category, $instrument, $password, $passwordR, $registCode);

        $data['title']  = "YouthGBZ";
        $data['forms']  = $forms;

        // Session::forget('message');
        return view('auth.register',$data);
    }
}
