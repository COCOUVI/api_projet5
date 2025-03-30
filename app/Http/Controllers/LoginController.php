<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function Connecting(Request $request){
        if( Auth::attempt($request->only(['email','password']))){
            $user=Auth::user();
            $token=$user->createToken('key_secret_only_for_backend')->plainTextToken;
            return response()->json([
                "status"=>403,
                "message"=>"User is login",
                "token"=>$token
            ]);
        } else{

            return response()->json([
                "status"=>403,
                "message"=>"information invalide",
            ]);
            
        }
   
    }
}
