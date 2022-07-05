<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Socialite;
use Auth;
use Exception;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleFacebookCallback()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            //dd($user);
            $finduser = User::where('facebook_id', $user->id)->first();
            
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect()->back();
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
    
                Auth::login($newUser);
     
                return redirect()->back();
            }
    
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
    }
}
