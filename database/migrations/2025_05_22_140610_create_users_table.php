<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 100); // الاسم الرباعي
            $table->string('phone', 9)->unique(); // رقم الهاتف
            $table->string('email', 100)->unique(); // البريد الإلكتروني
            $table->string('password'); // كلمة المرور
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
    
};