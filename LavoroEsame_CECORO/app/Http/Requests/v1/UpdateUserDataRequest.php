<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDataRequest extends FormRequest
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
            "nome" => 'required|string',
            "cognome" => 'required|string',
            "sesso" => 'int',
            "codiceFiscale" => 'required|string',
            "partitaIva" => 'string',
            "cittadinanza" => 'required|string',
            "cittaNascita" => 'required|string',
            "provinciaNascita" => 'required|string',
            "dataNascita" => 'required|string',
            "email" => 'string|email',
            "password" => 'string|min:6'
        ];
    }
    
}
