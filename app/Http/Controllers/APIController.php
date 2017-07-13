<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Hash;
use JWTAuth;
class APIController extends Controller
{
	
    public function register(Request $request)
    {        
    	$input = $request->all();
        
    	$input['password'] = Hash::make($input['password']);
    	User::create($input);
        return response()->json(['result'=>true]);
    }
    
    public function login(Request $request)
    {
    	$input = $request->all();
    	if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['result' => 'wrong email or password.']);
        }
        	//return response()->json(['result' => $token]);
            //dd('stop');
            return response('hello W')->cookie('result', $token, 300);
    }
    
    public function get_user_details(Request $request)
    {
    	
        $cookieValue = $request->cookie('result');
        $user = JWTAuth::toUser($cookieValue);
        
        //$input = $request->all();
    	//$user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $user]);
    }
    
    public function registeracija(Request $request)
    {
    	//$input = $request->all();
    	//$user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $request->all()]);
    }
    
}
