<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        //Fungsi Middleware ini dijalankan ketika dipanggil di route web.php
        //Cek apakah variabel empty $guard jika tidak maka false
        $guards = empty($guards) ? [null] : $guards;

        // dd($response = $next($request));
        //Looping value dari variabel $guards
        foreach ($guards as $guard) {
            //Cek apakah terautentikasi
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }

        }
        //Jika variable $guards kosong maka lanjutkan permintaan
        return $next($request);
    }
}
