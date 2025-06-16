<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    // دالة تسجيل دخول الأدمن
    public function login(Request $request)
    {
        // التحقق من صحة البيانات المطلوبة
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // البحث عن المستخدم بناءً على البريد الإلكتروني
        $user = User::where('email', $request->email)->first();

        // التحقق من وجود المستخدم وكلمة المرور
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'بيانات غير صحيحة'], 401);
        }

        // التحقق من أن المستخدم هو أدمن
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'غير مصرح لك بالدخول كآدمن'], 403);
        }

        // إنشاء توكن مخصص للأدمن
        $token = $user->createToken('admin_token')->plainTextToken;

        return response()->json([
            'message' => 'تم تسجيل الدخول كآدمن بنجاح',
            'user' => $user,
            'token' => $token,
        ]);
    }
}
