<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class userApiRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'role' => ['required', Rule::in(['teacher', 'user'])],
            'photo' => 'required|image|max:2048',
            'fcm' => 'nullable',
        ];

        if ($this->input('role') === 'teacher') {
            $rules['topics'] = 'required|string|max:255';
            $rules['cv'] = 'required|file|mimes:pdf,doc,docx|max:5120';
            $rules['certificate'] = 'required|';
            $rules['phone'] = 'required|string|max:20';
        }

        return $rules;
    }
}