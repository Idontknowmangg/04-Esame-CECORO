<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nome" => 'required|string|max:50',
            "cognome" => 'string|max:50',
            "sesso" => 'required|int|max:1',
            'codiceFiscale' => ['required', 'string', 'size:16', 'regex:/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i'],
            "partitaIva" => 'string',
            "cittadinanza" => 'required|string',
            "cittaNascita" => 'required|string',
            "provinciaNascita" => 'required|string',
            "dataNascita" => 'required|max:12',
            "email" => 'required|email|unique:contatti',
            "password" => 'required|string',
            "password_confirmation" => 'required|string'
        ];
    }
}
