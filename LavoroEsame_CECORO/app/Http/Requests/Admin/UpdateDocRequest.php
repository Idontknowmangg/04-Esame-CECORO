<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocRequest extends FormRequest
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
            'titoloDocumentario' => 'required|string',
            'idGenere' => 'required|int|max:5',
            'idImmagineDocumentario' => 'required|int|max:3',
            'idFormatoDocumentario' => 'required|int|max:3',
            'descrizione' => 'string',
            'regista' => 'string',
            'anno' => 'required|string',
            'durata' => 'required|string'
        ];
    }
}
