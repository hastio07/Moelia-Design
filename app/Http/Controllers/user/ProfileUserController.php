<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as RulesPassword;

class ProfileUserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user.ProfileUser', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->input('id'));

        $rules = [
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => "required|string|email:dns|max:255|unique:users,email," . $request->input('id'),
            'phone' => 'required|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'old_password' => 'required',
            'new_password' => ['nullable', 'min:5', 'max:255', RulesPassword::min(5)->letters()->mixedCase()->symbols()],
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
            'numeric' => ':attribute harus dalam format numerik.',
            'new_password.min' => ':attribute harus terdiri dari minimal :min karakter.',
        ];
        $customAttributes = [
            'nama_depan' => 'Nama Depan',
            'nama_belakang' => 'Nama Belakang',
            'email' => 'E-mail',
            'phone' => 'Telepon',
            'old_password' => 'Kata sandi lama',
            'new_password' => 'Kata sandi baru',
        ];
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $validatedData = $validator->validated();

        //Periksa kecocokan kata sandi lama
        $oldPassword = $validatedData['old_password'];
        if (!Hash::check($oldPassword, auth()->user()->password)) {
            return back()->with('status', 'Terjadi kesalahan kata sandi lama tidak cocok');
        }
        $data = [
            'nama_depan' => $validatedData['nama_depan'],
            'nama_belakang' => $validatedData['nama_belakang'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ];
        if ($validatedData['new_password']) {
            $data['password'] = Hash::make($request->input('new_password'));
        }
        $user->update($data);

        return redirect()->route('user-profile.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
