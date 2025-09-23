<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // cek login via session('role')
        if (! session('role')) {
            return redirect()->route('login')->with('error', 'Silakan login dulu!');
        }

        // jika ada pembatasan role, pastikan sesuai
        if (! empty($roles) && ! in_array(session('role'), $roles)) {
            return redirect()->route('home')->with('error', 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
