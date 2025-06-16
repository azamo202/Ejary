<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// تسجيل الدخول للمستخدمين والأدمن:
Route::post('login', [UserController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'login']);

// مجموعة الروتس المحمية بـ auth:sanctum فقط (بدون adminonly)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('users', UserController::class);
});
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // المسارات المحمية للمشرفين فقط
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});