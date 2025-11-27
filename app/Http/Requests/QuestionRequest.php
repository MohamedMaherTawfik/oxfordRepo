<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string|max:1000',
            'questions.*.options' => 'required|array|size:4',
            'questions.*.options.*.text' => 'required|string|max:255',
            'questions.*.options.*.is_correct' => 'required|in:true,false',
        ];
    }

    public function messages(): array
    {
        return [
            'questions.required' => 'You must add at least one question.',
            'questions.*.text.required' => 'Each question must have text.',
            'questions.*.options.required' => 'Each question must have 4 options.',
            'questions.*.options.*.text.required' => 'Each option must have text.',
            'questions.*.options.*.is_correct.required' => 'Each option must specify if it is correct or not.',
        ];
    }
}