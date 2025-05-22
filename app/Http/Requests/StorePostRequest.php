<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:60'],
            'content' => ['required', 'string'],
            'status' => ['nullable', Rule::in(['draft', 'scheduled', 'published'])],
            'published_at' => [
                'nullable',
                'date',
                Rule::requiredIf(function () {
                    return in_array($this->input('status'), ['scheduled', 'published']);
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'content.required' => 'The content field is required.',
            'status.required' => 'The status field is required.',
            'published_at.required' => 'The published_at field is required.',
            'title.max' => 'The title must not exceed 60 characters.',
        ];
    }
}
