<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:100',
            'phone' => 'required|string|size:9|unique:users,phone',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'الاسم الرباعي مطلوب.',
            'full_name.string'   => 'الاسم يجب أن يكون نصاً.',
            'full_name.max'      => 'الاسم يجب ألا يزيد عن 100 حرف.',

            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.string'   => 'رقم الهاتف يجب أن يكون نصاً.',
            'phone.size'     => 'رقم الهاتف يجب أن يتكون من 9 أرقام.',
            'phone.unique'   => 'رقم الهاتف مستخدم من قبل.',

            'email.required' => 'البريد الإلكتروني مطلوب.',
            'email.email'    => 'صيغة البريد الإلكتروني غير صحيحة.',
            'email.max'      => 'البريد الإلكتروني يجب ألا يزيد عن 100 حرف.',
            'email.unique'   => 'البريد الإلكتروني مستخدم من قبل.',

            'password.required'  => 'كلمة المرور مطلوبة.',
            'password.min'       => 'كلمة المرور يجب ألا تقل عن 6 أحرف.',
            'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
        ];
    }
}
