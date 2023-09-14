<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
// use App\Models\Role;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManageAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $me = $request->user();
        $this->authorize('view', $me);

        $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HASH_LENGTH'));

        return view('admin.ManageAdmin', compact('hashids'));
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
            'email' => 'required|email:rfc,dns|unique:admins,email',
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
            return back()->with('failed_add_account', 'gagal menambahkan akun')->withErrors($validator)->withInput();
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

        return redirect()->route('manage-admin.index')->with('success_add_account', 'berhasil menambahkan akun');
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
        $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HASH_LENGTH'));
        $decryptID = $hashids->decode($id);

        $adminedit = Admin::findOrFail($decryptID[0]); //cari user berdasarkan id pada model app/Models/Admin

        // if (request()->ajax()) {
        //     $data = $this->getDataForDataTables();
        //     return $this->renderDataTables($data);
        // }

        // $get_admins = Admin::with('role')->where('role_id', '=', 2)->latest('created_at')->get();
        return view('admin.ManageAdmin', compact('adminedit', 'hashids'));
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
        $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HASH_LENGTH'));
        $decryptID = $hashids->decode($id);
        // $admin = Admin::findOrFail($decryptID[0]);

        $rules = [
            'nama_depan' => 'required|string|min:5,nama_depan|max:255',
            'nama_belakang' => 'required|string|min:5|max:255',
            'role_id' => 'required|integer|min:1|in:2',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'email' => 'required|email:rfc,dns|unique:admins,email,' . $decryptID[0],
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
        //     $rules['email'] = 'required|email:rfc,dns|unique:admins,email';
        // }
        $validator = Validator::make($request->all(), $rules, $messages); // fungsi untuk Validasi request
        /**
         * Jika gagal maka tampilkan error dan request input sebelumnya
         */
        if ($validator->fails()) {

            return dd(back()->withErrors($validator)->withInput());
        }

        // dd(back()->withErrors($validator)->withInput());

        $admin = Admin::findOrFail($decryptID[0]);
        $admin->update([
            'nama_depan' => $request->input('nama_depan'),
            'nama_belakang' => $request->input('nama_belakang'),
            'role_id' => $request->input('role_id'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('manage-admin.index')->with('massage', 'data berhasil diubah');
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
        $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HASH_LENGTH'));
        $decryptID = $hashids->decode($id); //decrypt menjadi string
        $admin = Admin::findOrFail($decryptID[0]); //cari user berdasarkan id pada model app/Models/Admin
        $admin->delete();

        return redirect()->route('manage-admin.index')->with('massage', 'data berhasil dihapus');
    }

    public function destroyUser(User $data)
    {
        # Cek apakah ada pesanan yang menggunakan email user ini
        $isUserOrder = $data->pesanan()->withTrashed()->get();
        if ($isUserOrder->count() > 0) {
            return redirect()->route('manage-admin.index')->with('msg-tb-user', 'User ' . $data->nama_depan . ' ' . $data->nama_belakang . ' tidak berhasil dihapus karena sudah pernah memiliki riwayat pesanan');
        }
        $data->delete();
        return redirect()->route('manage-admin.index')->with('msg-tb-user', 'data berhasil dihapus');
    }

    public function renderDataTableAdmins()
    {
        if (request()->ajax()) {

            $akunAdmin = Admin::with('role')->where('role_id', '=', 2);

            if (request()->has('order') && !empty(request()->input('order'))) {
                $order = request()->input('order')[0];
                $columnIndex = $order['column'];
                $columnName = request()->input('columns')[$columnIndex]['data'];
                $columnDirection = $order['dir'];
                if ($columnName === 'Nama Admin') {
                    $akunAdmin->orderByRaw("CONCAT(nama_depan, ' ', nama_belakang) $columnDirection");
                } else {
                    $akunAdmin->orderBy($columnName, $columnDirection);
                }
            } else {
                $akunAdmin->latest('updated_at');
            }

            $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HASH_LENGTH'));

            return DataTables::eloquent($akunAdmin)
                ->addColumn('nama_admin', function ($value) {
                    return $value->nama_depan . ' ' . $value->nama_belakang;
                })
                ->editColumn('role_id', function ($value) {
                    return $value->role->level;
                })
                ->addColumn('aksi', function ($value) use ($hashids) {
                    return '<div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button class="btn btn-warning" data-route="' . route('manage-admin.edit', $hashids->encode($value->id)) . '" id="edit-button"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger" data-route="' . route('manage-admin.destroy', $hashids->encode($value->id)) . '" id="delete-button-admin"><i class="bi bi-trash"></i></button>
                        </div>';
                })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where(function ($query) use ($searchValue) {
                        $query->where('nama_depan', 'LIKE', "%$searchValue%")
                            ->orWhere('nama_belakang', 'LIKE', "%$searchValue%");
                    })->orWhere('email', 'LIKE', "%$searchValue%")->orWhere('phone_number', 'LIKE', "%$searchValue%")
                        ->orWhereHas('role', function ($query) use ($searchValue) {
                            $query->where('level', 'LIKE', "%$searchValue%");
                        });
                }
            })->rawColumns(['nama_admin', 'aksi'])->make(true);
        }
    }

    public function renderDataTableUsers()
    {
        if (request()->ajax()) {
            $akunUser = User::with('role');

            $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HASH_LENGTH'));

            return DataTables::eloquent($akunUser)
                ->addColumn('nama_user', function ($value) {
                    return $value->nama_depan . ' ' . $value->nama_belakang;
                })
                ->editColumn('role_id', function ($value) {
                    return $value->role->level;
                })
                ->addColumn('aksi', function ($value) use ($hashids) {
                    return '<div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button class="btn btn-danger" data-route="' . route('manage-admin.destroyUser', $hashids->encode($value->id)) . '" id="delete-button"><i class="bi bi-trash"></i></button>
                        </div>';
                })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where(function ($query) use ($searchValue) {
                        $query->where('nama_depan', 'LIKE', "%$searchValue%")
                            ->orWhere('nama_belakang', 'LIKE', "%$searchValue%");
                    })->orWhere('email', 'LIKE', "%$searchValue%")->orWhere('phone', 'LIKE', "%$searchValue%")
                        ->orWhereHas('role', function ($query) use ($searchValue) {
                            $query->where('level', 'LIKE', "%$searchValue%");
                        });
                }
            })->rawColumns(['nama_user', 'aksi'])->make(true);
        }
    }
}
