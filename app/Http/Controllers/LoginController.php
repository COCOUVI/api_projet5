<?php

namespace App\Http\Controllers;

use App\Models\ecole;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function Connecting(Request $request){
        if( Auth::attempt($request->only(['email','password']))){
            $user=Auth::user();
            $ecole = DB::table('ecoles')
                        ->where('id_user', '=', $user->id)
                        ->first();
            $token=$user->createToken('key_secret_only_for_backend')->plainTextToken;
            // dd($ecole);
            return response()->json([
                "status"=>403,
                "message"=>"User is login",
                "username"=>$user->name,
                "statut"=>$user->statut,
                "token"=>$token,
                "type"=> $ecole ? $ecole->type:""
            ]);
        } else{

            return response()->json([
                "status"=>403,
                "message"=>"information invalide",
            ]);
            
        }
   
    }
    public function destroy_connect(Request $request){
        $user=Auth::user();
        $user->tokens()->delete();

        return response()->json([
            "message" => "Vous êtes déconnecté avec succès",
        ], 200); // Code d'état 200 (OK)
    }
}
