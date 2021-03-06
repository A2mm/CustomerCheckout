<?php

namespace App\Http\Requests\Api\V1\Cart;

use Illuminate\Foundation\Http\FormRequest;

class AddCartApiRequest extends FormRequest
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
            
            'item_id' => [
                'required',
                'integer',
                'exists:items,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
            
        ];
    }
}
