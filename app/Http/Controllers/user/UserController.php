<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $user = Auth::user();
        return view('user.Profile')->with('user', $user);
    }
}
