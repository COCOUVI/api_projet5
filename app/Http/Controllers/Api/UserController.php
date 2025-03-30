<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoguserRequest;
use App\Http\Requests\RegisterUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function Register(RegisterUser  $request){

        // dd('ok');
        try {
            $user= new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            return response()->json([
                "status"=>200,
                "message"=>"vous etes bien enregsitrer",
                "register"=>$user


            ]);
        } catch (Exception $e){
            return response()->json($e);
        }

    }
    public function login(LoguserRequest $request){
        
        
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
