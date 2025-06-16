<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // تسجيل الدخول:
    public function login(LoginRequest $request)
    {
        $user = User::where('phone', $request->phone)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'رقم الهاتف أو كلمة المرور غير صحيحة.'
            ], 401);
        }

        // تحقق من نوع المستخدم: إذا كنت تريد أن تمنع الإدمن من الدخول من هنا
        if ($user->role === 'admin') {
            return response()->json([
                'message' => 'غير مصرح لهذا الحساب بالدخول من هنا.'
            ], 403);
        }

        $token = $user->createToken('user-token')->plainTextToken;
        return response()->json([
            'message' => 'تم تسجيل الدخول بنجاح.',
            'token' => $token,
            'user' => $user,
        ]);
    }

    // عرض كل المستخدمين:
    public function index()
    {
        return User::all();
    }

    // تسجيل مستخدم جديد:
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        // تعيين الدور تلقائيًا كمستخدم عادي
        $data['role'] = 'user';

        $user = User::create($data);
        return response()->json($user, 201);
    }

    // عرض مستخدم حسب ID:
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // حذف مستخدم:
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}

