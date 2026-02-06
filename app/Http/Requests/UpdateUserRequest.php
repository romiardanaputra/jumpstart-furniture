<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('id') ?? $this->input('user_id');

        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc,dns', 'unique:users,email,' . $userId],
            'contact' => ['required', 'string', 'min:10', 'max:15', 'unique:users,contact,' . $userId],
            'role' => ['required', 'string', 'in:admin,customer,guest'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already registered by another user.',
            'contact.unique' => 'This phone number is already registered by another user.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => strip_tags(trim($this->first_name ?? '')),
            'last_name' => strip_tags(trim($this->last_name ?? '')),
            'email' => strtolower(trim($this->email ?? '')),
            'contact' => preg_replace('/[^0-9+]/', '', $this->contact ?? ''),
        ]);
    }
}
