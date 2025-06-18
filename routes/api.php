<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// تسجيل الدخول للمستخدمين والأدمن:
Route::post('login', [UserController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'login']);

// جميع المسارات مسموحة بدون حماية
Route::apiResource('users', UserController::class);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
