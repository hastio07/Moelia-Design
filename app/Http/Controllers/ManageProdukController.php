<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as ImageResize;

class ManageProdukController extends Controller
{
    public function index()
    {
        //
        $get_products = Product::with('category')->latest()->get();
        $get_categories = Category::latest()->get();
        return view('dashboard.admin.manageproduk', compact('get_products', 'get_categories'));
    }

    public function store(Request $request)
    {
        //

        // return dd($request->all());
        // $array = array();
        // foreach ($request->rincianproduk as $i => $value) {
        //     $array[] = $value['namarincianproduk'];
        // }
        // return dd($array);
        $rules = [
            'namaproduk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'hargasewa' => 'required|numeric|integer',
            'rincianproduk' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {

            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::id(),
            'nama_produk' => $validatedData['namaproduk'],
            'kategori_id' => $validatedData['kategori'],
            'harga_sewa' => (int) $validatedData['hargasewa'],
            'rincian_produk' => $validatedData['rincianproduk'],
            'deskripsi' => $validatedData['deskripsi'],
        ];
        //Simpan gambar ke file storage/app/public
        if ($request->hasFile('gambar')) {

            $oriPath = $request->file('gambar')->store('post-images'); // -> /post-image/<nama_files.ext>
            $fileName = basename($oriPath);

            // kompres gambar dan simpan ke folder penyimpanan
            $thumbImage = ImageResize::make(storage_path('app/public/' . $oriPath));
            $thumbPath = storage_path('app/public/compressed/' . $fileName);
            $thumbImage->save($thumbPath, 20);
            $data['gambar'] = '/' . $fileName;
        }
        //Simpan produk
        Product::create($data);

        return redirect('dashboard/manage-produk')->with('success', 'data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        //

        $rules = [
            'namaproduk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'hargasewa' => 'required|numeric|integer',
            'rincianproduk' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'nama_produk' => $validatedData['namaproduk'],
            'kategori_id' => $validatedData['kategori'],
            'harga_sewa' => (int) $validatedData['hargasewa'],
            'rincian_produk' => $validatedData['rincianproduk'],
            'deskripsi' => $validatedData['deskripsi'],
        ];

        //Simpan gambar ke file storage/app/public
        if ($request->hasFile('gambar')) {
            if ($request->input('oldImage')) {
                Storage::delete(['compressed/' . $request->input('oldImage'), 'post-images/' . $request->input('oldImage')]);
            }
            $oriPath = $request->file('gambar')->store('post-images'); // -> /post-image/<nama_files.ext>
            $fileName = basename($oriPath);
            // kompres gambar dan simpan ke folder penyimpanan
            $thumbImage = ImageResize::make(storage_path('app/public/' . $oriPath));
            $thumbPath = storage_path('app/public/compressed/' . $fileName);
            $thumbImage->save($thumbPath, 20);
            $data['gambar'] = '/' . $fileName;
        }
        //Simpan produk
        Product::where('id', $id)->update($data);

        return redirect('dashboard/manage-produk')->with('success', 'data berhasil diubah');
    }

    public function destroy($id)
    {
        //
        $get_products = Product::findOrFail($id);
        if ($get_products->gambar) {
            $path = $get_products->gambar;
            Storage::delete(['compressed/' . $path, 'post-images/' . $path]);
        }
        Product::destroy($id);
        return redirect('/dashboard/manage-produk')->with('success', 'Data Berhasil DiHapus!');
    }

    public function createcategory(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|string|max:255',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return back()->with('error_add_category', 'Data gagal disimpan')->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
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
