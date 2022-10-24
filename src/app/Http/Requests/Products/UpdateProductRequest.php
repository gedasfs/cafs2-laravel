<?php

namespace App\Http\Requests\Products;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'code' => ['required', 'string', 'max:255', sprintf('unique:%s,code,%d', Product::class, $this->product?->id)],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'numeric', 'gt:0', sprintf('exists:%s,id', Category::class)],
            'description' => ['required', 'string'],
        ];
    }
}
