<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreNazioniRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
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
            "continente" => 'required|string|max:2',
            "iso" => 'required|string|max:2',
            "iso3" => 'required|string|max:3',
            "prefissoTelefonico" => 'required|string|max:8',
        ];
    }
}
