<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Log;

class AuthController extends Controller
{
    public function register(Request $request){
       Log::info("start");
        $user = new User;
        $user->firstName = $request->firstname;
        $user->lastname = $request->lastname;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        Log::info("com");
        return response()->json(['status'=>true, 'message'=>'Registered Successfully']);

    }

    public function login(Request $request){
        // return $request;

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email',$request->email)->first();

        if(!$user)
            return response()->json(['email' => 'Invalid Email.']);

        if($user)
        {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['status'=>true, 'message', 'Welcome, Login Successfully']);
            }      
            else{
                return response()->json(['message','Invalid Password']);
            }
        }
    }

}
