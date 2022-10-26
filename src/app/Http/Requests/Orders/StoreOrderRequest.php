<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'products' => ['required', 'array', 'min:1'],
            'products.*' => ['required', 'numeric'],
            'qtys' => ['required', 'array', 'min:1'],
            'qtys.*' => ['required', 'numeric'],
        ];
    }
}
