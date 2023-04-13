<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('authenticate.login.index');
    }

    public function authenticate(Request $request)
    {
        //
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
        // dd('berhasil login');

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();

            // if (Auth::guard('admins')->user()->role_id === 1) {
            //     return redirect()->intended('/dashboard');
            // }
            return redirect()->intended('/dashboard');
        }
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('failed', 'Login gagal!'); // ditaruh di session flash massage kalau withError dipanggil di @error
    }

    public function destroy(Request $request)
    {
        //
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function create()
    {
        return view('authenticate.register.index');
    }
}
