<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreListRequest extends FormRequest
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
            "nome" => 'required|string|min:6',
            "cognome" => 'required|string|min:6',
            "sesso" => 'int|max:1',
            "codiceFiscale" => ['required', 'string', 'size:16', 'regex:/^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i'],
            "partitaIva" => 'string',
            "cittadinanza" => 'required|string',
            "cittaNascita" => 'required|string',
            "provinciaNascita" => 'required|string',
            "dataNascita" => 'required|string',
            "email" => 'required|string|email|unique:contatti',
            "password" => 'required|string|unique:contatti',
            "password_confirmation" => 'required|string|unique:contatti',
            "isAdmin" => 'required|int|max:1'
        ];
    }
}
