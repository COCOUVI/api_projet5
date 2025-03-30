<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoguserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'email'=>'required|email|exists:users,email',
            'password'=>'required',

        ];
    }
    public function failedValidation(Validator $validator){

        throw new HttpResponseException(response()->json([
            'success' => false,
            'status' => 422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorList' => $validator->errors()->toArray() // Convertir les erreurs en tableau
        ])->header('Content-Type', 'application/json'));
    }

    public function messages(){
        return [
               'name.required'=>'le nom est requis',
               'email.email'=>'Adresse email non valide',
                'email.exists'=>'cette adresse email n \'existe pas dans notre application',
                'password.required'=>'Mot de passe non fournir '
        ];
    
    } 
}

    

