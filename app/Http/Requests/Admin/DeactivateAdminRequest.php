<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DeactivateAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:admins,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'ID është e detyrueshme.',
            'id.exists' => 'ID e dhënë nuk egziston në tabelën e administratorëve.',
        ];
    }
}
