<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryJabatan;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as ImageResize;
use Yajra\DataTables\Facades\DataTables;

class ManagePegawaiController extends Controller
{

    private function renderDataTables($data)
    {
        return DataTables::eloquent($data)
            ->editColumn('besaran_gaji', function ($value) {
                return $value->formatRupiah('besaran_gaji');
            })
            ->editColumn('jabatan', function ($value) {
                return $value->categoryjabatan->nama_jabatan;
            })
            ->editColumn('foto', function ($value) {
                if ($value->foto) {
                    return '<img alt="' . $value->nama . '" height="150" src="/storage/compressed' . $value->foto . '" width="180">';
                } else {
                    return '<img alt="' . $value->nama . '" height="150" src="https://dummyimage.com/180x150.png" width="180">';
                }
            })
            ->addColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-warning" data-bs-pegawai="' . $json . '" data-bs-route="' . route('manage-pegawai.update', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" data-bs-route="' . route('manage-pegawai.destroy', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                </div>';
            })->filter(function ($query) {
            if (request()->has('search') && !empty(request()->get('search')['value'])) {
                $searchValue = request()->get('search')['value'];
                $query->where('nama', 'LIKE', "%$searchValue%")
                    ->orWhere('alamat_domisili', 'LIKE', "%$searchValue%")
                    ->orWhere('kontak', 'LIKE', "%$searchValue%")
                    ->orWhere('besaran_gaji', 'LIKE', "%$searchValue%")
                    ->orWhereHas('categoryjabatan', function ($query) use ($searchValue) {
                        $query->where('nama_jabatan', 'LIKE', "%$searchValue%");
                    });
            }
        })
            ->rawColumns(['foto', 'aksi'])
            ->make(true);
    }

    public function index()
    {
        if (request()->ajax()) {

            $pegawai = Employee::with('categoryjabatan');

            if (request()->has('order') && !empty(request()->input('order'))) {
                $order = request()->input('order')[0];
                $columnIndex = $order['column'];
                $columnName = request()->input('columns')[$columnIndex]['data'];
                $columnDirection = $order['dir'];
                $pegawai->orderBy($columnName, $columnDirection);
            } else {
                $pegawai->latest('updated_at');
            }

            return $this->renderDataTables($pegawai);
        }
        $get_jabatan = CategoryJabatan::latest()->get();

        return view('admin.ManagePegawai', compact('get_jabatan'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'gaji' => 'required|numeric|max:9999999999',
            'jabatan' => 'required|string',
            'show_data' => 'required|in:ya,tidak',
            'foto' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'foto.max' => 'ukuran gambar maksimal 2MB',
            'regex' => 'format :attribute tidak valid',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
        ];
        // Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        // Custom Attribute Name
        $validator->setAttributeNames([
            'nama' => 'Nama',
            'alamat' => 'Alamat Domisili',
            'kontak' => 'Kontak',
            'gaji' => 'Besaran Gaji',
            'jabatan' => 'Jabatan',
            'foto' => 'Foto',
        ]);

        // Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_employee', 'Gagal menambahkan data pegawai'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        // Mengambil data tervalidasi
        $validatedData = $validator->validated();

        // Menampung data request setelah validasi
        $data = [
            'nama' => $validatedData['nama'],
            'alamat_domisili' => $validatedData['alamat'],
            'kontak' => $validatedData['kontak'],
            'besaran_gaji' => (int) $validatedData['gaji'],
            'jabatan' => $validatedData['jabatan'],
            'show_data' => $validatedData['show_data'],
        ];
        // Menyimpan foto ke folder storage/app/public
        if ($request->hasFile('foto')) {
            // Menyimpan file foto asli ke folder employee-images
            $oriPath = $request->file('foto')->store('employee-images'); // -> /employee-images/<nama_file.ext>
            $fileName = basename($oriPath);
            // Mengkompres foto dan simpan hasil ke folder stroage/public/compresed
            $thumbImage = ImageResize::make(storage_path('app/public/' . $oriPath));
            $thumbPath = storage_path('app/public/compressed/' . $fileName);
            $thumbImage->save($thumbPath, 20);
            $data['foto'] = '/' . $fileName;
        }
        // Menyimpan Pegawai
        Employee::create($data);

        return redirect()->route('manage-pegawai.index')->with('success_add_employee', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'gaji' => 'required|numeric|integer',
            'jabatan' => 'required|string',
            'show_data' => 'required|in:ya,tidak',
            'foto' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'foto.max' => 'ukuran gambar maksimal 2MB',
            'regex' => 'format :attribute tidak valid',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
        ];
        // Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        // Custom Attribute Name
        $validator->setAttributeNames([
            'nama' => 'Nama',
            'alamat' => 'Alamat Domisili',
            'kontak' => 'Kontak',
            'gaji' => 'Besaran Gaji',
            'jabatan' => 'Jabatan',
            'foto' => 'Foto',
        ]);
        // Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_employee', 'Gagal mengubah data pegawai'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        // Mengambil data tervalidasi
        $validatedData = $validator->validated();
        // Menampung data request setelah validasi
        $data = [
            'nama' => $validatedData['nama'],
            'alamat_domisili' => $validatedData['alamat'],
            'kontak' => $validatedData['kontak'],
            'besaran_gaji' => (int) $validatedData['gaji'],
            'jabatan' => $validatedData['jabatan'],
            'show_data' => $validatedData['show_data'],
        ];
        // Menyimpan foto ke folder storage/app/public
        if ($request->hasFile('foto')) {
            // Memeriksa keberadaan file foto lama
            if ($request->input('oldImage')) {
                Storage::delete(['compressed/' . $request->input('oldImage'), 'employee-images/' . $request->input('oldImage')]);
            }
            // Menyimpan file foto asli ke folder employee-images
            $oriPath = $request->file('foto')->store('employee-images'); // -> /employee-images/<nama_file.ext>
            $fileName = basename($oriPath);
            // Mengkompres foto dan simpan hasil ke folder stroage/public/compresed
            $thumbImage = ImageResize::make(storage_path('app/public/' . $oriPath));
            $thumbPath = storage_path('app/public/compressed/' . $fileName);
            $thumbImage->save($thumbPath, 20);
            $data['foto'] = '/' . $fileName;
        }
        // Menyimpan Pegawai
        $employee = Employee::findOrFail($id);
        $employee->update($data);
        return redirect()->route('manage-pegawai.index')->with('success_edit_employee', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $get_empolyees = Employee::findOrFail($id);
        if ($get_empolyees->foto) {
            $path = $get_empolyees->foto;
            Storage::delete(['compressed/' . $path, 'employee-images/' . $path]);
        }
        Employee::destroy($id);
        return redirect()->route('manage-pegawai.index')->with('success_delete_employee', 'Data berhasil dihapus');
    }

    public function createjabatan(Request $request)
    {
        $rules = [
            'nama_jabatan' => 'required|string|max:255|unique:category_jabatans',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'regex' => 'format :attribute tidak valid',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'unique' => 'kategori :attribute sudah ada',
        ];
        // Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        // Custom Attribute Name
        $validator->setAttributeNames([
            'nama_jabatan' => $request->input('nama_jabatan'),
        ]);
        // Jika gagal
        if ($validator->fails()) {
            return back()->with('error_add_categoryjabatan', 'Gagal menambahkan jabatan')->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        // Mengambil data tervalidasi
        $validatedData = $validator->validated();
        // Menampung data request setelah validasi
        $data = [
            'nama_jabatan' => $validatedData['nama_jabatan'],
        ];
        // Menyimpan kategori jabatan
        CategoryJabatan::create($data);
        return redirect()->route('manage-pegawai.index')->with('success_add_categoryjabatan', 'Data berhasil disimpan');
    }

    public function destroyjabatan($id)
    {
        $get_jabatan = CategoryJabatan::findOrFail($id);
        // Memeriksa apakah ada pegawai yang menggunakan kategori jabatan tersebut
        if ($get_jabatan->employee()->get()->count() > 0) {
            return redirect()->route('manage-pegawai.index')->with('error_delete_categoryjabatan', 'Kategori jabatan ini tidak dapat dihapus karena saat ini masih digunakan oleh beberapa pegawai');
        }
        // Jika tidak ada pegawai yang menggunakan kategori ini, maka hapus kategori jabatan tersebut
        $get_jabatan->delete();
        return redirect()->route('manage-pegawai.index')->with('success_delete_categoryjabatan', 'Data berhasil dihapus');
    }
}
