<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'total_price' => ['required','int'],
            'date'=> Carbon::now(),
            //'price_per_unit'=>['required','int'],
            'quantity'=>['required'],
            'drug_id'=>['required']
        ];
    }
}
