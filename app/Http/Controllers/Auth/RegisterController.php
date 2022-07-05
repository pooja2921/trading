<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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

    use RegistersUsers,MustVerifyEmail;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';
    protected $redirectConfirmationTo = '/register';
    protected $redirectAfterRegistrationTo = "/register";
    protected $guard = "web";


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->redirectTo = route("dashboard");
        $this->redirectConfirmationTo = route("dashboard");
        $this->redirectAfterRegistrationTo = route("dashboard");
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
            'mobile' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'password_confirmation'=>'required|string|same:password'
        ]);
    }

    public function register(Request $request) 
{
    //return $request;
    $user = User::create($this->validator($request->all())->validate());

   event(new Registered($user));

   auth()->login($user);

   return redirect('/')->with('success', "Account successfully registered.");
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    /*public function register(Request $request)
    {
        //return $request;
        $request['otp']= '1234';
        $this->validator($request->all())->validate();

        //$this->SMSSend($request, $debug=false);

        event(new Registered($user = $this->create($request->all())));

        
        //$this->guard()->login($user);

        

          $userinfo=$request;
        return view('auth.otp',compact('userinfo'));

       return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }*/


    

    
}
