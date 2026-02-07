<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->role === 'admin';
    }

    /**
     * Prepare the data for validation (Sanitization)
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'blog_title' => strip_tags(trim($this->blog_title ?? '')),
            'blog_tags' => strip_tags(trim($this->blog_tags ?? '')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'blog_title' => ['required', 'string', 'max:200'],
            'blog_tags' => ['required', 'string', 'max:100'],
            'blog_long_description' => ['required', 'string'],
            'blog_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:1024'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'blog_title.required' => 'Blog title is required.',
            'blog_title.max' => 'Blog title cannot exceed 200 characters.',
            'blog_tags.required' => 'At least one tag is required.',
            'blog_long_description.required' => 'Blog description is required.',
            'blog_image.image' => 'The uploaded file must be an image.',
            'blog_image.max' => 'Image size cannot exceed 1MB.',
        ];
    }
}
