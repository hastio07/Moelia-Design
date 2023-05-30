<?php

namespace App\Http\Controllers;

use App\Models\CategoriesBarang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;

class ManageGudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_categories = CategoriesBarang::latest()->get();
        return view('dashboard.admin.ManageGudang', compact('get_categories'));
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
    }
    public function createcategory(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|string|max:255|unique:categories',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
            'unique' => 'Kategori sudah ada!',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return back()->with('error_add_category', 'Data gagal disimpan!')->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        //Menampung data request setelah validasi
        $data = [
            'nama_kategori' => $validatedData['nama_kategori'],
        ];
        //Simpan kategori
        Category::create($data);
        return redirect('dashboard/manage-produk')->with('success_add_category', 'Data berhasil disimpan');
    }
    public function destroycategory($id)
    {
        $get_category = Category::findOrFail($id);
        // cek apakah ada produk yang menggunakan kategori ini
        $products = $get_category->product()->get();
        if ($products->count() > 0) {
            return redirect('/dashboard/manage-produk')->with('error_category', 'Kategori tidak bisa dihapus karena masih digunakan oleh produk!');
        }
        // jika tidak ada produk yang menggunakan kategori ini, maka hapus kategori
        $get_category->delete();
        return redirect('/dashboard/manage-produk')->with('success_category', 'Data Berhasil DiHapus!');
    }
}
