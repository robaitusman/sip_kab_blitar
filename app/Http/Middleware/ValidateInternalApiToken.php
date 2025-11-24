<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateInternalApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-Internal-Token') ?? $request->query('token');
        $expected = config('services.internal_api.token');

        if (!$expected || $token !== $expected) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
