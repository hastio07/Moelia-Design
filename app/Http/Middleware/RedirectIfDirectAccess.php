<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RedirectIfDirectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        dd($request);
        if (!$request->isMethod('post')) {
            $previousUrl = URL::previous();

            // Periksa apakah URL sebelumnya tidak sama dengan URL saat ini
            if ($previousUrl && $previousUrl !== $request->fullUrl()) {
                return redirect($previousUrl);
            }
        }
        return $next($request);

    }
}
