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
}
