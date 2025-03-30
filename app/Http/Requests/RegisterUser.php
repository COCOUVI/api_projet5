<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterUser extends FormRequest
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
            
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required'


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
               'email.required'=>'Une adresse email est requis',
                'email.unique'=>'cette adresse email existe deja',
                'password.required'=>'le mot de passe est requis'
        ];
    
    } 
}
