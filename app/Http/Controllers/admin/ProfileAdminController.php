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
        return view('admin.profileadmin');
    }

    public function savedata(Request $request)
    {
        try {
            if ($request->has('oldPassword') || $request->has('newPassword')) {
                $additionalData = $request->get('additionalData');
                $oldPassword = $request->get('oldPassword');
                $newPassword = $request->get('newPassword');

                $rules = [
                    'oldPassword' => ['required', 'string', 'min:5'],
                    'newPassword' => ['required', 'string', 'min:5'],
                ];
                $massages = [
                    'min' => ':attribute harus diisi minimal :min karakter.',
                    'required' => ':attribute wajib diisi.',
                    'string' => ':attribute harus berupa string/teks.',
                ];
                $customAttributes = [
                    'oldPassword' => 'Kata sandi lama',
                    'newPassword' => 'Kata sandi baru',
                ];

                $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->errors(),
                    ]);
                }

                #Match The Old Password
                if (!Hash::check($oldPassword, auth()->user()->password)) {
                    return response()->json(['status' => false, 'errors' => ['message' => ['Terjadi kesalahan kata sandi lama tidak cocok']]]);
                }
                $data = [
                    $additionalData => Hash::make($newPassword),
                ];
                #Update the new Password
                Admin::where('id', auth()->user()->id)->update($data);

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil ubah kata sandi',
                ]);

            } else {

                // Lakukan pengambilan data dari sumber eksternal atau operasi lainnya
                $additionalData = str_replace('-', '_', $request->get('additionalData')); // Nama kolom yang ingin diperbarui
                $dataName = $request->get('dataName'); // Nilai yang ingin diupdate
                $userID = $request->get('userID');

                $admin = Admin::findOrFail($userID);

                $data = [
                    $additionalData => $dataName,
                ];

                $admin->update($data);

                // Jika berhasil, kirim respons sukses
                return response()->json([
                    'success' => true,
                    'add' => $additionalData,
                    'data' => $dataName,
                    'id' => $userID,
                ]);
            }
        } catch (\Exception $e) {
            // Tangani kesalahan yang terjadi

            // Kirim respons error dengan status 500
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data'], 500);
        }

    }
}
