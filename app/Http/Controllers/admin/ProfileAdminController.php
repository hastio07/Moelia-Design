<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileAdminController extends Controller
{
    public function index()
    {
        return view('admin.ProfileAdmin');
    }

    public function savedata(Request $request)
    {
        try {
            if ($request->has('oldPassword') || $request->has('newPassword')) {
                $additionalData = $request->get('additionalData');
                $oldPassword = $request->get('oldPassword');
                $newPassword = $request->get('newPassword');
                //Buat autran untuk setiap nilai yang datang dari elemen input
                $rules = [
                    'oldPassword' => ['required', 'string', 'min:5'],
                    'newPassword' => ['required', 'string', 'min:5'],
                ];
                //Buat pesan kesalahan
                $massages = [
                    'min' => ':attribute harus diisi minimal :min karakter.',
                    'required' => ':attribute wajib diisi.',
                    'string' => ':attribute harus berupa string/teks.',
                ];
                //Membantu memberikan pesan validasi yang lebih deskriptif dan informatif kepada pengguna.
                $customAttributes = [
                    'oldPassword' => 'Kata sandi lama',
                    'newPassword' => 'Kata sandi baru',
                ];
                //Memastikan bahwa data yang diterima memenuhi persyaratan atau aturan tertentu sebelum digunakan dalam operasi berikutnya,
                $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);
                //Jika gagal
                if ($validator->fails()) {
                    //Kembalikan response dalam bentuk json beserta data error dari validator-nya
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                    ]);
                }

                //Periksa kecocokan kata sandi lama
                if (!Hash::check($oldPassword, auth()->user()->password)) {
                    return response()->json(['status' => false, 'errors' => ['message' => ['Terjadi kesalahan kata sandi lama tidak cocok']]]);
                }
                //Simpan nilai name + value dari elemen input
                $data = [
                    $additionalData => Hash::make($newPassword),
                ];
                //Ubah ke kata sandi baru
                Admin::where('id', auth()->user()->id)->update($data);
                //Kirim response dalam bentuk json
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil ubah kata sandi',
                ]);

            } else {

                //Dapatkan nilai name dari elemen input
                $additionalData = str_replace('-', '_', $request->get('additionalData')); // Nama kolom yang ingin diperbarui
                //Dapatkan nilai dari elemen input
                $dataName = $request->get('dataName'); // Nilai yang ingin diupdate
                //Dapatkan admin id  yang saat ini login
                $userID = auth()->user()->id; // $userID = $request->get('userID');
                //Cari data admin by id di model admin
                $admin = Admin::findOrFail($userID);
                //Buat autran untuk setiap nilai yang datang dari elemen input
                $rules = [
                    'nama_depan' => 'sometimes|required|string|min:5,nama_depan|max:255',
                    'nama_belakang' => 'sometimes|required|string|min:5|max:255',
                    'phone_number' => 'sometimes|required|regex:/^([0-9\s\-\+\(\)]*)$/',
                    'email' => 'sometimes|required|email:rfc,dns|unique:admins,email,' . $userID,
                ];
                //Buat pesan kesalahan
                $massages = [
                    'email' => ':attribute harus berupa alamat surel yang valid.',
                    'in' => ':attribute yang dipilih tidak valid.',
                    'max' => ':attribute harus diisi maksimal :max karakter.',
                    'min' => ':attribute harus diisi minimal :min karakter.',
                    'regex' => 'Format :attribute tidak valid.',
                    'required' => ':attribute wajib diisi.',
                    'unique' => ':attribute sudah digunakan.',
                ];
                //Membantu memberikan pesan validasi yang lebih deskriptif dan informatif kepada pengguna.
                $customAttributes = [
                    'nama_depan' => 'Nama Depan',
                    'nama_belakang' => 'Nama Belakang',
                    'phone_number' => 'Telepon',
                    'email' => 'E-mail',
                ];
                //Simpan nilai name + nilai dari elemen input ke dalam array
                $data = [
                    $additionalData => $dataName,
                ];

                //Memastikan bahwa data yang diterima memenuhi persyaratan atau aturan tertentu sebelum digunakan dalam operasi berikutnya,
                $validator = Validator::make($data, $rules, $massages, $customAttributes);
                //Jika gagal
                if ($validator->fails()) {
                    //Kembalikan response dalam bentuk json beserta data error dari validator-nya
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                    ]);
                }

                $admin->update($data);

                // Jika berhasil, kirim respons sukses
                return response()->json([
                    'success' => true,
                ]);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan yang terjadi

            // Kirim respons error dengan status 500
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data'], 500);
        }

    }
}
