<?php

namespace App\Http\Requests\Members;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMemberRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $memberId = $this->route('member') ? $this->route('member')->id : null;

        return [
            'title' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'orderNr' => [
                'required',
                'integer',
                'min:1',
                Rule::unique('members', 'orderNr')->ignore($memberId),
            ],
            'imageUrl' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
            'title.required' => 'Titulli është i detyrueshëm.',
            'title.string' => 'Titulli duhet të jetë një varg tekstual.',
            'title.max' => 'Titulli nuk mund të jetë më i gjatë se 50 karaktere.',

            'name.required' => 'Emri është i detyrueshëm.',
            'name.string' => 'Emri duhet të jetë një varg tekstual.',
            'name.max' => 'Emri nuk mund të jetë më i gjatë se 255 karaktere.',

            'position.required' => 'Pozicioni është i detyrueshëm.',
            'position.string' => 'Pozicioni duhet të jetë një varg tekstual.',
            'position.max' => 'Pozicioni nuk mund të jetë më i gjatë se 255 karaktere.',

            'email.required' => 'Adresa e email-it është e detyrueshme.',
            'email.email' => 'Adresa e email-it nuk është e vlefshme.',
            'email.max' => 'Adresa e email-it nuk mund të jetë më e gjatë se 255 karaktere.',

            'orderNr.required' => 'Numri i rendit është i detyrueshëm.',
            'orderNr.integer' => 'Numri i rendit duhet të jetë një numër i plotë.',
            'orderNr.min' => 'Numri i rendit duhet të jetë të paktën 1.',
            'orderNr.unique' => 'Ky numër rendi është tashmë i zënë nga një anëtar tjetër.',

            'imageUrl.image' => 'Skedari duhet të jetë një imazh.',
            'imageUrl.mimes' => 'Imazhi duhet të jetë i tipit: JPEG, PNG, JPG ose GIF.',
            'imageUrl.max' => 'Imazhi nuk mund të jetë më i madh se 2MB.',
        ];
    }
}
