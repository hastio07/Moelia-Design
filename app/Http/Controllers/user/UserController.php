<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $user = Auth::user();
        return view('user.Profile')->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->input('id'));

        $user->update([
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        return redirect()->route('user-profile.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
