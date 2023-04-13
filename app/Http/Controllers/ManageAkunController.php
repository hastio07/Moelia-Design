<?php

namespace App\Http\Controllers;

use App\Models\Admin;
// use App\Models\Role;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ManageAkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $guardName = Auth::getDefaultDriver(); // Mendapatkan nama guard default yang sedang aktif saat ini
        // $guard = auth()->guard($guardName); // Mendapatkan instance guard dengan nama guard default
        // $user = $guard->user(); // Mendapatkan objek user dari guard default

        $this->authorize('view', [Admin::class]);
        $get_admins = Admin::with('role')->where('role_id', '=', 2)->latest('created_at')->get(); //untuk menampilkan semua admins
        // $roles = Role::all()->where('id', '=', 2); // menampilkan table role

        $hashids = new Hashids(env('HASHIDS_KEY'), 20);
        return view('dashboard.admin.manageakun', compact('get_admins', 'hashids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'nama_depan' => 'required|string|min:5,nama_depan|max:255',
            'nama_belakang' => 'required|string|min:5|max:255',
            'role_id' => 'required|integer|min:1|in:2',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email:dns|unique:admins,email',
            'password' => 'required|min:5|max:255|confirmed',
        ];
        $massages = [
            'confirmed' => 'konfirmasi :attribute tidak cocok.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
            'in' => ':attribute yang dipilih tidak valid.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'regex' => 'Format :attribute tidak valid.',
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
        ];
        $validator = Validator::make($request->all(), $rules, $massages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        // dd($request->all());
        $data_admin = [
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'role_id' => (int) $request->input('role_id'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ];
        Admin::create($data_admin);

        return redirect('dashboard/manage-akun')->with('success', 'data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        /**
         * Fungsi tampilkan data admin berdasarkan id
         */
        $hashids = new Hashids(env('HASHIDS_KEY'), 20);
        $decryptID = $hashids->decode($id);

        $adminedit = Admin::findOrFail($decryptID[0]); //cari user berdasarkan id pada model app/Models/Admin

        $get_admins = Admin::with('role')->where('role_id', '=', 2)->latest('created_at')->get();
        return view('dashboard.admin.manageakun', compact('get_admins', 'adminedit', 'hashids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        /**
         * Fungsi simpan perubahan data ke model app/Models/User
         */
        $hashids = new Hashids(env('HASHIDS_KEY'), 20);
        $decryptID = $hashids->decode($id);
        // $admin = Admin::findOrFail($decryptID[0]);

        $rules = [
            'nama_depan' => 'required|string|min:5,nama_depan|max:255',
            'nama_belakang' => 'required|string|min:5|max:255',
            'role_id' => 'required|integer|min:1|in:2',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email:dns|unique:admins,email,' . $decryptID[0],
            // 'password' => 'required|min:5|max:255|confirmed',
        ];
        $messages = [
            // 'confirmed' => 'konfirmasi :attribute tidak cocok.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
            'in' => ':attribute yang dipilih tidak valid.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'regex' => 'Format :attribute tidak valid.',
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah digunakan.',
        ];
        // if ($request->input('email') != $admin->email) {
        //     $rules['email'] = 'required|email:dns|unique:admins,email';
        // }
        $validator = Validator::make($request->all(), $rules, $messages); // fungsi untuk Validasi request
        /**
         * Jika gagal maka tampilkan error dan request input sebelumnya
         */
        if ($validator->fails()) {

            return dd(back()->withErrors($validator)->withInput());
        }

        // dd(back()->withErrors($validator)->withInput());
        Admin::where('id', $decryptID[0])->update([
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'role_id' => $request->input('role_id'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
        ]);

        return redirect('dashboard/manage-akun')->with('massage', 'data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $hashids = new Hashids(env('HASHIDS_KEY'), 20);
        $decryptID = $hashids->decode($id); //decrypt menjadi string
        // $admin = Admin::findOrFail($decryptID); //cari user berdasarkan id pada model app/Models/Admin
        // $admin->delete();
        Admin::where('id', $decryptID[0])->delete();

        return redirect('dashboard/manage-akun')->with('massage', 'data berhasil dihapus');
    }
}
