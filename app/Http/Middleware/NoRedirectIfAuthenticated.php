<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class NoRedirectIfAuthenticated
{
    /* Middleware ini adalah untuk kasus jika pengguna login atau tidak maka masih bisa menampilkan halaman.
     * Middleware ini juga adalah kasus untuk pengguna login maka data informasi si pengguna login bisa di akses di halaman.
     * Middleware ini juga tidak redirect ke halaman tertentu.
     */

    /**
     * Instansi factory Authentikasi.
     *
     * @var \Illuminate\Contracts\Auth\Factory $auth
     */
    protected $auth;

    /**
     * Membuat sebuah instansi middleware baru
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Menangani permintaan yang datang
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // true jika kosong
        // false jika ada
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            // Jika guard di web.php didefinisikan
            // Jika ya login maka gunakan data loginnya sesuai guard
            // Jika tidak login maka tetap bisa akses halaman
            if ($this->auth->guard($guard)->check()) {
                // untuk mengubah guard yang aktif saat ini ke guard yang ditentukan agar dapat melalukan operasi berikutnya
                $this->auth->shouldUse($guard);
                return $next($request);
            } else {
                return $next($request);
            }
            // Jika guard di web.php tidak didefinisikan
            if ($guard == 'null') {
                return $next($request);
            }
        }

    }

}
