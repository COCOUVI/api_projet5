<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function store(Request $request)
    {   
        // Récupérer l'utilisateur connecté
        $utilisateur = Auth::user();

        if ($utilisateur) {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls|max:2048', // Validation pour les fichiers Excel
            ]);
    
            if ($request->hasFile('file')) {
                
                $folderPath = sprintf("schoolfolder/",$utilisateur->name,"/");
                // Vérifier si le dossier existe, sinon le créer
                if (!Storage::disk('public')->exists($folderPath)) {
                    Storage::disk('public')->makeDirectory($folderPath);
                }
    
                // Stocker le fichier dans le dossier
                $filePath = $request->file('file')->storeAs($folderPath, $request->file('file')->getClientOriginalName(), 'public');
    
                return response()->json(['path' => $filePath], 201);
            }
    
            return response()->json(['message' => 'Aucun fichier Excel téléchargé.'], 400);
        } else {
            // Aucun utilisateur n'est connecté
            echo "Aucun utilisateur n'est connecté.";
        }
        
}
}