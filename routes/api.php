<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//crecuperer un poste
Route::get('/posts',[PostController::class,'index']
);
//ajouter un post 
//inscrire un nouvel utilisateur
// Route::post("/register",[UserController::class,"Register"]);
// Route::post('/login',[UserController::class,"login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('posts/create',[PostController::class,'store']);
    Route::put('/posts/edit/{post}',[PostController::class,"update"]);
    Route::delete('/posts/{post}',[PostController::class,"Remove"]);

    // ... et ainsi de suite ...
});
//Route pour authentification
Route::post('/register',[RegisterController::class,"register"]);
Route::post('/login',[LoginController::class,"Connecting"]);
Route::post("/upload",[UploadController::class,"store"]);
Route::get('/test',function(){
       return "helllo test , one two";
});

Route::post('/logout',[LoginController::class,"destroy_connect"])->middleware('auth');