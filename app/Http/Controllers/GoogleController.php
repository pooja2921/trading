<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Redirect;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        //return 'test';
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->stateless()->user();
            //dd($user);
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
               //dd('if');
                /*$updateUser = User::whereId($finduser->id)->update([
                    'avatar' => $user->avatar
                    ]);*/
                Auth::login($finduser);
      
                return \Redirect::intended('/');
       
            }else{
                //dd('else');
                 $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'social_type'=> 'google',
                    'password' => encrypt('my-google'),
                    'avatar' => $user->avatar,
                ]);
      
                Auth::login($newUser);
      
                return redirect()->route('dashboard');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
