<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class footerRequest extends FormRequest
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
            'whatsapp' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'facebook' => 'nullable|max:255',
            'instgram' => 'nullable|max:255',
            'x' => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'google_play' => 'nullable|max:255',
            'app_store' => 'nullable|max:255',
        ];
    }
}
