<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtSessionMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = session('jwt_token'); // ambil token dari session
            if (! $token) {
                return redirect()->route('login')->with('error', 'Silakan login dulu!');
            }

            $user = JWTAuth::setToken($token)->authenticate();
            if (! $user) {
                return redirect()->route('login')->with('error', 'Token tidak valid!');
            }

            auth()->setUser($user);
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Token expired atau invalid!');
        }

        return $next($request);
    }
}
