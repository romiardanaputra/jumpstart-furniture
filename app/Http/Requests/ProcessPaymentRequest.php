<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Prepare the data for validation.
     * Sanitization step - clean input before validation
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'card_holder_name' => strip_tags(trim($this->card_holder_name ?? '')),
            'shipping_address' => strip_tags(trim($this->shipping_address ?? '')),
            // Remove any non-numeric characters from card number
            'card_number' => preg_replace('/[^0-9]/', '', $this->card_number ?? ''),
            'cvv' => preg_replace('/[^0-9]/', '', $this->cvv ?? ''),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'card_number' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'card_holder_name' => ['required', 'string', 'max:255'],
            'cvv' => ['required', 'string', 'min:3', 'max:4', 'regex:/^[0-9]+$/'],
            'expiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
            'shipping_method' => ['required', 'in:exclusive,standard'],
            'shipping_address' => ['required', 'string', 'max:500'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'card_number.size' => 'Card number must be exactly 16 digits.',
            'card_number.regex' => 'Card number must contain only numbers.',
            'cvv.regex' => 'CVV must contain only numbers.',
            'expiry.regex' => 'Expiry must be in MM/YY format.',
            'shipping_method.in' => 'Invalid shipping method selected.',
        ];
    }
}
