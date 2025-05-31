<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phoneNumber' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'address' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:15', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Fusha e emrit është e detyrueshme.',
            'name.string' => 'Emri duhet të jetë një varg tekstual.',
            'name.max' => 'Emri nuk mund të jetë më i gjatë se 255 karaktere.',

            'lastname.required' => 'Fusha e mbiemrit është e detyrueshme.',
            'lastname.string' => 'Mbiemri duhet të jetë një varg tekstual.',
            'lastname.max' => 'Mbiemri nuk mund të jetë më i gjatë se 255 karaktere.',

            'phoneNumber.required' => 'Fusha e numrit të telefonit është e detyrueshme.',
            'phoneNumber.string' => 'Numri i telefonit duhet të jetë një varg tekstual.',
            'phoneNumber.max' => 'Numri i telefonit nuk mund të jetë më i gjatë se 20 karaktere.',

            'email.required' => 'Fusha e email-it është e detyrueshme.',
            'email.email' => 'Adresa e email-it nuk është e vlefshme.',
            'email.unique' => 'Kjo adresë email-i është tashmë e regjistruar.',

            'address.required' => 'Fusha e adresës është e detyrueshme.',
            'address.string' => 'Adresa duhet të jetë një varg tekstual.',
            'address.max' => 'Adresa nuk mund të jetë më e gjatë se 255 karaktere.',

            'username.required' => 'Fusha e emrit të përdoruesit është e detyrueshme.',
            'username.string' => 'Emri i përdoruesit duhet të jetë një varg tekstual.',
            'username.max' => 'Emri i përdoruesit nuk mund të jetë më i gjatë se 15 karaktere.',
            'username.unique' => 'Ky emër përdoruesi është tashmë i zënë.',

            'password.required' => 'Fusha e fjalëkalimit është e detyrueshme.',
            'password.string' => 'Fjalëkalimi duhet të jetë një varg tekstual.',
            'password.min' => 'Fjalëkalimi duhet të ketë të paktën 8 karaktere.',
            'password.confirmed' => 'Konfirmimi i fjalëkalimit nuk përputhet.',
        ];
    }
}
