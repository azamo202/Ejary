<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user(); // يعمل مع auth:sanctum

        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        return response()->json(['message' => 'غير مصرح لك بالوصول.'], 403);
    }
}
