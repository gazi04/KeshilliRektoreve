<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;

class CreateNotificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'imageUrl' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'datetime' => ['required', 'date'],
            'title' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'notificationType' => ['required', 'in:Lajm,Konkurs,Komunikatë'],
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
            'imageUrl.required' => 'Imazhi është i detyrueshëm.',
            'imageUrl.image' => 'Skedari duhet të jetë një imazh.',
            'imageUrl.mimes' => 'Imazhi duhet të jetë i tipit: JPEG, PNG, JPG ose GIF.',
            'imageUrl.max' => 'Imazhi nuk mund të jetë më i madh se 2MB.',

            'datetime.required' => 'Data dhe ora janë të detyrueshme.',
            'datetime.date' => 'Data dhe ora nuk janë të vlefshme.',

            'title.required' => 'Titulli është i detyrueshëm.',
            'title.string' => 'Titulli duhet të jetë tekst.',
            'title.max' => 'Titulli nuk mund të jetë më i gjatë se 200 karaktere.',

            'description.required' => 'Përshkrimi është i detyrueshëm.',
            'description.string' => 'Përshkrimi duhet të jetë tekst.',

            'notificationType.required' => 'Lloji i njoftimit është i detyrueshëm.',
            'notificationType.in' => 'Lloji i zgjedhur i njoftimit nuk është i vlefshëm.',
        ];
    }
}
