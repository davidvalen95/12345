<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\Helper\Form;
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


        $request->flash();
        $this->validate($request,array(
            'password' => 'required|confirmed',
            'instrument' => 'required',
            'name' => 'required|min:3|max:20',
            'email' => 'required|unique:users',
            'registrationCode' => 'required|in:hendri'


        ));

        $user = new User($request->all());
        $user->password = bcrypt($user->password);

        return redirect('/');
    }

    protected function showRegistrationForm(){
        $name         = new Form("Full Name","name","text","glyphicon-user");
        $email        = new Form("Email","email","email","glyphicon-envelope");
        $optionMusik  = array(
        "gitar"=>"Gitar",
        "drum"=>"Drum",
        "bass" => "Bass",
        "keyboard" => "Keyboard"
        );
        $instrument   = new Form("Instrument", "instrument", "select", "glyphicon-music",  $optionMusik);
        $password     = new Form("Password","password","password","glyphicon-lock");
        $passwordR    = new Form("Retype password","password_confirmation","password","glyphicon-lock");

        $registCode   = new Form("Registration Code","registrationCode","text","glyphicon-tag");



        $forms = array($name, $email, $instrument, $password, $passwordR, $registCode);

        $data['title']  = "YouthGBZ";
        $data['forms']  = $forms;

        return view('auth.register',$data);
    }
}
