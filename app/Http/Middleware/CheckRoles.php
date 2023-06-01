<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$owners)
    {
        // dd($owners);
        $roles = Role::all();
        $guardName = Auth::getDefaultDriver();
        $owners = empty($owners) ? [null] : $owners;
        # code...
        foreach ($owners as $owner) {
            foreach ($roles as $roleFromRolesDB) {
                # code...
                /** misal sebuah halaman menerapkan role:super_admin
                 *  super_admin === super_admin && 1 !== 1 -> true and false  = false
                 *  super_admin === admin && 1 !== 2 -> false and true = false
                 *  super_admin === super_user && 1 !== 3 -> false and true = false
                 *
                 *  Yang login admin ke halaman tersebut
                 *  super_admin === super_admin && 2 !== 1 -> true and true  = true
                 *  super_admin === admin && 2 !== 2 -> false and false = true
                 *  super_admin === super_user && 2 !== 3 -> false and true = false
                 */
                //Cek kempemilikan halaman
                if ($owner === $roleFromRolesDB->level && auth($guardName)->user()->role_id === $roleFromRolesDB->id) {
                    //Boleh masuk ke halaman tersebut
                    return $next($request);
                }
            }
        }
        // Jika terbukti true tidak sah
        //Dilempar ke /dashboard
        return redirect()->route('dashboard');
    }
}
