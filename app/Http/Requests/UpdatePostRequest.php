<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Facades\Auth;
use App\Models\Post;

class UpdatePostRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,scheduled,published'],
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
