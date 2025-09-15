<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('login')->with('error', 'Silakan login dulu!');
        }

        if ($user->role !== $role) {
            return redirect()->route('home')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
