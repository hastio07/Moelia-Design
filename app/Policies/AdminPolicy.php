<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // public function before()
    // {
    //     if (Auth::check() && Auth::user()->role_id === 1) {
    //         return true; // Super admin can perform any action
    //     }
    // }

    public function view(Admin $admin)
    {
        return $admin->role_id === 1;
    }
}
