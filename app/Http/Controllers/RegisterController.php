<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
use App\Models\ecole;
use App\Models\ProfcoursSalle;
use App\Models\professeur;
use App\Models\tuteur;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\Generator\StringManipulation\Pass\Pass;




class RegisterController extends Controller
{
    public function register (RegisterUser $request){
        function isexiste_prof($request){
            $exist_prof=false;
            $teacher = DB::table('profcours_salles')
                    ->where('email_prof', '=', $request->email)
                    ->exists();
            if($teacher){
                $exist_prof = true;
            }else{
                $exist_prof = false;
            }return $exist_prof;
        }
        function isexist_tuteur($request){
            return true;
        }

        function registercontrol($request){
            $exist = false;
            if($request->name && $request->email && $request->password && $request->tel && $request->statut){

                if($request->statut=="ecole" && $request->type && $request->address){
                    $exist = true;
                }elseif($request->statut=="prof" && $request->prenom && $request->type){
                    $exist = isexiste_prof($request);   
                }elseif($request->statut=="tuteur" && $request->prenom){
                    $exist = isexist_tuteur($request);
                }
            }else{
                $exist = false;
            }return $exist;
        }
        try{
        if(registercontrol($request)){
            $user= new User();
                $user->name=$request->name;
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->tel=$request->tel;
                $user->statut=$request->statut;
                $user->save();
                if($user->save()){
                    if($request->statut=="ecole"){
                        $ecole=new ecole();
                        $ecole->type=$request->type;
                        $ecole->address=$request->address;
                        $ecole->id_user=$user->id;
                        $ecole->save();
                    }elseif($request->statut=="prof"){
                        $prof=new professeur();
                        $prof->prenom=$request->prenom;
                        $prof->type=$request->type;
                        $prof->id_user=$user->id;
                        $prof->save();
                    }elseif($request->statut=="tuteur"){
                        $tuteur=new tuteur();
                        $tuteur->prenom=$request->prenom;
                        $tuteur->id_user=$user->id;
                        $tuteur->save();
                    };
                        return response()->json([
                        "message"=>"tous donner enregistrer",
                         "status"=>201
    
                        ]);                 
                    }
                    return response()->json([
                    "message"=>"user enregistrer uniquement",
                     "status"=>201

                    ]);                 
                }else{
                    return response()->json([
                    "message"=>"verifier les entrer",
                    "status"=>403
                    ]);                 
        }
     }catch(Exception $e){
         Log::error('Erreur lors de l\'enregistrement : ' . $e->getMessage());
        return response()->json([
            "message" => "Erreur de serveur lors de l'enregistrement.".$e,
            "status" => 500, // Internal Server Error
        ], 500);
     }
        
    }      
}
