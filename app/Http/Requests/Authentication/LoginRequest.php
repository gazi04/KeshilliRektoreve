<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:15'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Fusha e emrit të përdoruesit është e detyrueshme.',
            'username.string' => 'Emri i përdoruesit duhet të jetë një varg tekstual.',
            'username.max' => 'Emri i përdoruesit nuk mund të jetë më i gjatë se 15 karaktere.',

            'password.required' => 'Fusha e fjalëkalimit është e detyrueshme.',
            'password.string' => 'Fjalëkalimi duhet të jetë një varg tekstual.',
            'password.min' => 'Fjalëkalimi duhet të ketë të paktën 8 karaktere.',
        ];
    }
}
