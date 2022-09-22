<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity'=>['required','int'],
            'price'=>['required','int'],
            'price_for_public' => ['required','int'],
            'place'=>['required','string'],
        ];
    }
}
