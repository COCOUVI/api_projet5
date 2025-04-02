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
                "username"=>$user->name,
                "statut"=>$user->statut,
                "token"=>$token
            ]);
        } else{

            return response()->json([
                "status"=>403,
                "message"=>"information invalide",
            ]);
            
        }
   
    }
    public function destroy_connect(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            "message" => "Vous êtes déconnecté avec succès",
        ], 200); // Code d'état 200 (OK)
    }
}
