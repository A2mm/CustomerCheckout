<?php

namespace App\Http\Requests\Api\V1\Payment;

use Illuminate\Foundation\Http\FormRequest;

class PlaceTransactionApiRequest extends FormRequest
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
            
            'address' => [
                'required',
                'string',
                'max:150',
            ],

            'telephone' => [
                'required',
            ],

            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

        ];
    }
}
