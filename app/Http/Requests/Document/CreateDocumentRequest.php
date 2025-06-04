<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx,odt', 'max:10240'],
            'type' => ['required', 'string', 'max:100'],
            'conferenceId' => ['required', 'integer', 'exists:conferences,id'],
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
            'title.max' => 'Titulli nuk mund të jetë më i gjatë se 255 karaktere.',

            'url.required' => 'Skedari i dokumentit është i detyrueshëm.',
            'url.file' => 'URL-ja duhet të jetë një skedar.',
            'url.mimes' => 'Skedari duhet të jetë i tipit: PDF, DOC, DOCX, PPT, PPTX ose ODT.',
            'url.max' => 'Skedari nuk mund të jetë më i madh se 10MB.',

            'type.required' => 'Lloji i dokumentit është i detyrueshëm.',
            'type.string' => 'Lloji i dokumentit duhet të jetë një varg tekstual.',
            'type.max' => 'Lloji i dokumentit nuk mund të jetë më i gjatë se 100 karaktere.',

            'conferenceId.required' => 'ID e konferencës është e detyrueshme.',
            'conferenceId.integer' => 'ID e konferencës duhet të jetë një numër i plotë.',
            'conferenceId.exists' => 'Konferenca me këtë ID nuk egziston.',
        ];
    }
}
