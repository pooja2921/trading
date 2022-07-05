<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiController extends Controller
{
       //use AuthenticatesUsers;
       public function __construct() {
      
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gettoken(){
        return 'test';
          /*$token = Str::random(60);
          $user['remember_token'] = $token;
                    
        return User::create($user);
 
      return \Response::json(["status"=>"success", "message"=>"Records inserted successfully!","token"=>$token]);*/

    }

    
    public function login(Request $request)
    {
        $data = $request->all();
        
        $rules = array(
        'phone'      => 'required|exists:users,phone',
        'password'=>'required|password'
        
        );

         $credentials = request(['phone', 'password']);
         $validator = Validator::make($data, $rules);

        if (!Auth::attempt($credentials)) {
             $error = array('status' => 'error', 'validation' => $validator->errors(), 'msg' => 'Plese Fix Validation Error');
            return response()->json($error, 200);
        }
        //$user = $request->user();

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('passport_token')->accessToken;

            User::where('phone',$request->phone)->update(['api_token'=>$token]);
            
            return response()->json([
                'success' => true,
                'message' => 'User login succesfully, Use token to authenticate.',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User authentication failed.'
            ], 401);
        }
    }
         

    public function username()
    {
        return 'phone';
    }

    public function logout()
    {
        if (Auth::check()) {
       Auth::user()->token()->delete();
       //$token->revoke();
    }

        return response()->json(['status'=>'success','message' => 'User successfully signed out']);
    }
}
