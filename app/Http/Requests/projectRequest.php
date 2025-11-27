<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class projectRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:graduation_projects,title',
            'description' => 'required|string|max:1000',
            'status' => 'required|in:pending,approved,rejected',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:20048',
        ];
    }
}
