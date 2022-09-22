<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrugRequest extends FormRequest
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


    public function rules(): array
    {
        return [
            'name' => ['required','string'],
            'expiration_date' => ['required','date'],
            'quantity' => ['required','int'],
            'price' => ['required','int'],
            'company' => ['required','string'],
            'body_system' => ['required','string'],
            'prescription'=>['required','boolean'],
            'form'=>['required','string'],
            'place'=>['required','string'],
            'scientific_name'=>['required','string'],
            'dose'=>['required','int'],
            'price_for_public'=>['required','int'],
        ];
    }
}
