<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\CategoryBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManageGudangController extends Controller
{

    private function getDataForDataTables()
    {
        $get_barang = Barang::with('categorybarang')->latest('created_at')->get();
        return $get_barang;
    }
    private function renderDataTables($data)
    {
        return DataTables::of($data)
            ->addColumn('Kategori', function ($value) {
                return $value->categorybarang->nama_kategori_barang;
            })
            ->addColumn('Aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-warning" data-bs-product="' . $json . '" data-bs-route="' . route('manage-gudang.update', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" data-bs-route="' . route('manage-gudang.destroy', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                </div>';
            })
            ->rawColumns(['Kategori', 'Aksi'])
            ->make();
    }
    public function index()
    {
        if (request()->ajax()) {
            $data = $this->getDataForDataTables();
            return $this->renderDataTables($data);
        }
        $get_category_barang = CategoryBarang::latest()->get();
        return view('admin.managegudang', compact('get_category_barang'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|numeric|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        // Custom Attribute Name
        $validator->setAttributeNames([
            'nama' => 'Nama Barang',
            'kategori' => 'Kategori Barang',
            'stok' => 'Stok',
        ]);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_barang', 'Gagal menambahkan data barang'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'nama_barang' => $validatedData['nama'],
            'kategori_id' => (int) $validatedData['kategori'],
            'stok' => (int) $validatedData['stok'],
        ];
        //Simpan barang
        Barang::create($data);
        return redirect()->route('manage-gudang.index')->with('success_add_barang', 'Data berhasil disimpan');

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|numeric|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        // Custom Attribute Name
        $validator->setAttributeNames([
            'nama' => 'Nama Barang',
            'kategori' => 'Kategori Barang',
            'stok' => 'Stok',
        ]);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_barang', 'Gagal mengubah data barang'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'nama_barang' => $validatedData['nama'],
            'kategori_id' => (int) $validatedData['kategori'],
            'stok' => (int) $validatedData['stok'],
        ];
        //Simpan barang
        Barang::where('id', $id)->update($data);

        return redirect()->route('manage-gudang.index')->with('success_edit_barang', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $get_barang = Barang::findOrFail($id);
        if (!$get_barang) {
            // Jika model Barang tidak ditemukan, lakukan tindakan yang sesuai
            return abort(404, 'Barang tidak ditemukan');
        }
        $get_barang->delete();
        return redirect()->route('manage-gudang.index')->with('success_delete_barang', 'Data berhasil dihapus');
    }

    public function createcategorybarang(Request $request)
    {
        $rules = [
            'nama_kategori_barang' => 'required|string|max:255|unique:category_barangs',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'unique' => ':attribute sudah digunakan',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return back()->with('error_add_categorybarang', 'Gagal menambahkan kategori barang')->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        //Menampung data request setelah validasi
        $data = [
            'nama_kategori_barang' => $validatedData['nama_kategori_barang'],
        ];
        //Simpan kategori
        CategoryBarang::create($data);
        return redirect()->route('manage-gudang.index')->with('success_add_categorybarang', 'Data berhasil disimpan');
    }
    public function destroycategorybarang($id)
    {
        $get_category = CategoryBarang::findOrFail($id);
        // cek apakah ada gudang yang menggunakan kategori ini
        if ($get_category->barang()->get()->count() > 0) {
            return redirect()->route('manage-gudang.index')->with('error_delete_categorybarang', 'Kategori barang ini tidak dapat dihapus karena saat ini masih digunakan oleh beberapa barang');
        }
        // jika tidak ada gudang yang menggunakan kategori ini, maka hapus kategori
        $get_category->delete();
        return redirect()->route('manage-gudang.index')->with('success_delete_categorybarang', 'Data berhasil dihapus');
    }
}
