<?php

namespace App\Http\Requests\Conference;

use Illuminate\Foundation\Http\FormRequest;

class EditConferenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:conferences,id'],
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID e konferencës është e detyrueshme.',
            'id.exists' => 'Konferenca me këtë ID nuk egziston.',

            'title.required' => 'Titulli është i detyrueshëm.',
            'title.string' => 'Titulli duhet të jetë një varg tekstual.',
            'title.max' => 'Titulli nuk mund të jetë më i gjatë se 255 karaktere.',

            'date.required' => 'Data është e detyrueshme.',
            'date.date' => 'Data nuk është një format i vlefshëm i datës.',
        ];
    }
}
