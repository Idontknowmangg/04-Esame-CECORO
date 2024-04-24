<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class BuyCreditsRequest extends FormRequest
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
            "personal_info" => ['required', 'string', 'regex:/^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$|^\d{4} \d{4} \d{4} \d{4}$/'],
            "setCrediti" => "required|int|max:1000"
        ];
    }
}
