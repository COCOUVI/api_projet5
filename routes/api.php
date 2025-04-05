<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController; // Renommé pour plus de clarté
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Récupérer un poste
Route::get('/posts', [PostController::class, 'index']);

// Inscrire un nouvel utilisateur
Route::post('/register', [RegisterController::class, 'register']); // Utilisation d'un contrôleur d'authentification cohérent

// Se connecter
Route::post('/login', [LoginController::class, 'Connecting'])->name('login'); // Utilisation d'un contrôleur d'authentification cohérent

// Route pour le test
Route::get('/test', function () {
    return "helllo test , one two";
});

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Informations de l'utilisateur authentifié
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Gestion des posts
    Route::post('/posts/create', [PostController::class, 'store']);
    Route::put('/posts/edit/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']); // Utilisation de 'destroy' pour la suppression

    // Déconnexion
    Route::post('/logout', [LoginController::class, 'destroy_connect']); // Utilisation d'un contrôleur d'authentification cohérent et de 'logout'

    // Route pour l'upload (nécessite une réflexion sur la sécurité)
    Route::post("/upload", [UploadController::class, "store"]);
});