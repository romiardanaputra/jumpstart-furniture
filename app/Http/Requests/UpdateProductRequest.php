<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'product_name' => strip_tags(trim($this->product_name ?? '')),
            'product_short_description' => strip_tags(trim($this->product_short_description ?? '')),
            'product_long_description' => strip_tags(trim($this->product_long_description ?? '')),
            'product_shipping_and_return' => strip_tags(trim($this->product_shipping_and_return ?? '')),
            'product_vendor' => strip_tags(trim($this->product_vendor ?? '')),
            'product_tags' => strip_tags(trim($this->product_tags ?? '')),
            'product_price' => is_numeric($this->product_price) ? (float) $this->product_price : null,
            'product_discount' => is_numeric($this->product_discount) ? (float) $this->product_discount : 0,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'product_rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'product_price' => ['required', 'numeric', 'min:0'],
            'product_short_description' => ['required', 'string', 'max:500'],
            'product_type' => ['required', 'string', 'max:100'],
            'product_sku' => ['required', 'string', 'max:100'],
            'product_vendor' => ['required', 'string', 'max:255'],
            'product_availability' => ['required', 'in:true,false,1,0'],
            'product_tags' => ['required', 'string', 'max:255'],
            'product_color' => ['required', 'string', 'max:100'],
            'product_material' => ['required', 'string', 'max:100'],
            'product_long_description' => ['required', 'string'],
            'product_shipping_and_return' => ['required', 'string'],
            'product_discount' => ['required', 'numeric', 'min:0', 'max:100'],
            // Image is optional on update
            'product_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:1024'],
        ];
    }
}
