<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone'    => 'required|string|size:9',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.size'        => 'رقم الهاتف يجب أن يتكون من 9 أرقام.',
            'password.required' => 'كلمة المرور مطلوبة.',
        ];
    }

}
