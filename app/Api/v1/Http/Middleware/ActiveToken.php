<?php

namespace App\Api\v1\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActiveToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('token');

        if (!$token) {
            return response()->json([
                'message' => 'Token header is required',
                'error' => [
                    'http_code' => 403,
                ]
            ], 403);
        }

        $token = Token::where('token', $token)
            ->whereNull('used_at')
            ->where('expired_at', '>=', now())
            ->first();

        if (!$token) {
            return response()->json([
                'message' => 'Token has expired',
                'error' => [
                    'http_code' => 403,
                ]
            ], 403);
        }

        return $next($request);
    }
}
