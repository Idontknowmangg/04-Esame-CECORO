<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTVSeriesRequest extends FormRequest
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
            "titoloSerieTV" => 'required|string',
            "idGenere" => 'required|int|max:5',
            "idImmagineSerieTV" => 'required|int|max:3',
            "descrizione" => 'string',
            "regista" => 'string',
            "totStagioni" => 'required|int|max:20',
            "totEp" => 'required|int|max:100',
            "anno" => 'required|string'
        ];
    }
}
