<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostrequest;
use App\Http\Requests\EditPostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class PostController extends Controller
{
    //
    public function index(Request $request){
        try {
            $query= Post::query();
            $perpage=2;
            $page=$request->input('page',1);
            $search=$request->input('search');
    
            if($search){
                $query->whereRaw("titre LIKE '%". $search."%'");
            }
            $total=$query->count();
            
            $result=$query->offset(($page -1)*$perpage)->limit($perpage)->get();
            return response()->json([
                'status_code'=>201,
                'status_message'=>'le post ont été  recuperer avec succès',
                 'current_page'=>$page,
                 'last_page'=>ceil($total/$perpage),
                 'items'=>$result
            ]);


        }catch(Exception $e){
            return response()->json($e);
        }
    }
    public function store( CreatePostrequest $request){
        try{
            $post= new Post();
            $post->titre=$request->titre;
            $post->description=$request->description; 
            $post->user_id=Auth::user()->id;
            $post->save();
    
            return response()->json([
                'status_code'=>201,
                'status_message'=>'le post a été  ajouter',
                 'post'=>$post
            ]);

        } catch (Exception $e){
               
           return response()->json($e);
        }
       
    }
    public function update(EditPostRequest $request,Post $post){
       try{
            $post->titre=$request->titre;
            $post->description=$request->description;
            if($post->user_id===Auth::user()->id){
                    
                $post->save();
            } else{
                return response()->json([
                    "status"=>422,
                    "success"=>true,
                    "message"=>"vous n'\ etes pas autoriser a editer ce post"
                ]); 

            }
            return response()->json([
                "status"=>201,
                "success"=>true,
                "message"=>"post updated sucessfully",
                "post"=>$post
            ]);   
       } catch(Exception $e) {
          
           return response()->json($e);
       }
    }
    public function Remove(Post $post){
        if($post->user_id==Auth::user()->id){
            $post->delete();
        } else{
            return response()->json([
                "status"=>402,
                "message"=>"Suprression non autoriser "
            ]);    

        }
        return response()->json([
            "status"=>201,
            "message"=>"post is deleted sucessfully"
        ]);
    }

}
