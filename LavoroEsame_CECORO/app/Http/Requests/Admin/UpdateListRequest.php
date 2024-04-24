<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListRequest extends FormRequest
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
            "nome" => 'string|min:6',
            "cognome" => 'required|string|min:6',
            "sesso" => 'int|max:1',
            "codiceFiscale" => ['string', 'size:16', 'regex:/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i'],
            "partitaIva" => 'string',
            "cittadinanza" => 'required|string',
            "cittaNascita" => 'required|string',
            "provinciaNascita" => 'required|string',
            "dataNascita" => 'required|string',
            "email" => 'string|email',
            "password" => 'required|string|unique:contatti',
            "password_confirmation" => 'string|unique:contatti',
            "isAdmin" => 'int|max:1'
        ];
    }
}
