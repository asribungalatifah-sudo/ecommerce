<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            // 🔥 numeric, BUKAN integer
            'price'          => ['required', 'numeric', 'min:1000'],
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],

            'stock'  => ['required', 'integer', 'min:0'],
            'weight' => ['required', 'integer', 'min:1'],

            'images'   => ['nullable', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpg,png,webp', 'max:2048'],

            'is_active'   => ['boolean'],
            'is_featured' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'price' => (float) preg_replace('/[^0-9]/', '', $this->price),

            'discount_price' => $this->discount_price
                ? (float) preg_replace('/[^0-9]/', '', $this->discount_price)
                : null,

            'is_active'   => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }
}
