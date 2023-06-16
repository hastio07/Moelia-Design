<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ImageResize;
use Yajra\DataTables\Facades\DataTables;

class ManageProdukController extends Controller
{
    public function index()
    {
        //
        $get_category_product = CategoryProduct::latest()->get();
        if (request()->ajax()) {
            $get_products = Product::with('category_products')->orderBy('updated_at', 'desc');
            return DataTables::eloquent($get_products)->editColumn('kategori_id', function ($value) {
                return $value->category_products->nama_kategori;
            })->editColumn('harga_sewa', function ($value) {
                return $value->formatRupiah('harga_sewa');
            })->editColumn('rincian_produk', function ($value) {
                return Str::words(strip_tags($value->rincian_produk), 5);
            })->editColumn('deskripsi', function ($value) {
                return Str::words($value->deskripsi, 5);
            })->editColumn('gambar', function ($value) {
                if ($value->gambar) {
                    return '<img alt="' . $value->nama_produk . '" height="150" src="/storage/compressed' . $value->gambar . '" width="180">';
                } else {
                    return '<img alt="' . $value->nama_produk . '" height="150" src="https://dummyimage.com/180x150.png" width="180">';
                }
            })->editColumn('album_produk', function ($value) {
                $album = json_decode($value->album_produk, true);
                if (is_array($album)) {
                    $output = '<ul>';
                    foreach ($album as $item) {
                        $output .= '<li>' . $item . '</li>';
                    }
                    $output .= '</ul>';
                    return $output;
                } else {
                    return '';
                }

            })->addColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button class="btn btn-warning" data-bs-product="' . $json . '" data-bs-route="' . route('manage-produk.update', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger" data-bs-route="' . route('manage-produk.destroy', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                         </div>';
            })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where(function ($query) use ($searchValue) {
                        $query->where('nama_produk', 'LIKE', "%$searchValue%")
                            ->orWhereHas('category_products', function ($query) use ($searchValue) {
                                $query->where('nama_kategori', 'LIKE', "%$searchValue%");
                            })
                            ->orWhere('harga_sewa', 'LIKE', "%$searchValue%")
                            ->orWhere('rincian_produk', 'LIKE', "%$searchValue%")
                            ->orWhere('deskripsi', 'LIKE', "%$searchValue%");
                    });
                }
            })->rawColumns(['gambar', 'album_produk', 'aksi'])->make(true);
        }
        return view('admin.manageproduk', compact('get_category_product'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

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
            'albumproduk.*' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_product', 'Gagal menambahkan data produk'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->role_id,
            'nama_produk' => $validatedData['namaproduk'],
            'kategori_id' => (int) $validatedData['kategori'],
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

        if ($request->hasFile('albumproduk')) {
            $thumbnails = [];
            foreach ($request->file('albumproduk') as $file) {
                $oriPathsAlbumProduk = $file->store('album-produk');
                $thumbnails[] = $oriPathsAlbumProduk;
            }

            $thumbnailsJson = json_encode($thumbnails, JSON_UNESCAPED_SLASHES);
            $data['album_produk'] = $thumbnailsJson;
        }
        //Simpan produk
        Product::create($data);

        return redirect()->route('manage-produk.index')->with('success_add_product', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        //
        $rules = [
            'namaproduk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'hargasewa' => 'required|numeric|max:9999999999|integer',
            'rincianproduk' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'albumproduk.*' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_product', 'Gagal mengubah data produk'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'nama_produk' => $validatedData['namaproduk'],
            'kategori_id' => (int) $validatedData['kategori'],
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

        if ($request->hasFile('albumproduk')) {
            $album_produk = Product::findOrFail($id);
            // Jika sebelumnya di db kolom album_produk sudah ada isinya
            if (!is_null($album_produk->album_produk)) {
                $gambar = json_decode($album_produk->album_produk, true);
                // Menghapus gambar sebelumnya dari storage
                foreach ($gambar as $index => $value) {
                    Storage::delete($value);
                }
                // Mengosongkan gambar sebelumnya dari kolom album_produk
                $album_produk->album_produk = null;
                $album_produk->save();
            }
            $thumbnails = [];
            foreach ($request->file('albumproduk') as $file) {
                $oriPathsAlbumProduk = $file->store('album-produk');
                $thumbnails[] = $oriPathsAlbumProduk;
            }
            $thumbnailsJson = json_encode($thumbnails, JSON_UNESCAPED_SLASHES);
            $data['album_produk'] = $thumbnailsJson;
        }
        //Simpan produk
        Product::where('id', $id)->update($data);

        return redirect()->route('manage-produk.index')->with('success_edit_product', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $get_products = Product::findOrFail($id);
        if ($get_products->gambar) {
            $path = $get_products->gambar;
            Storage::delete(['compressed/' . $path, 'post-images/' . $path]);
        }
        if (!is_null($get_products->album_produk)) {
            $path2 = json_decode($get_products->album_produk, true);
            foreach ($path2 as $index => $value) {
                Storage::delete($value);
            }
        }
        Product::destroy($id);
        return redirect()->route('manage-produk.index')->with('success_delete_product', 'Data berhasil dihapus');
    }

    public function createcategory(Request $request)
    {
        $rules = [
            'nama_kategori' => 'required|string|max:255|unique:category_products',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'unique' => ':attribute sudah digunakan',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        // Custom Attribute Name
        $validator->setAttributeNames([
            'nama_kategori' => $request->input('nama_kategori'),
        ]);
        //Jika gagal
        if ($validator->fails()) {
            return back()->with('error_add_categoryproduct', 'Gagal menambahkan kategori produk')->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        //Menampung data request setelah validasi
        $data = [
            'nama_kategori' => $validatedData['nama_kategori'],
        ];
        //Simpan kategori
        CategoryProduct::create($data);
        return redirect()->route('manage-produk.index')->with('success_add_categoryproduct', 'Data berhasil disimpan');
    }
    public function destroycategory($id)
    {
        $get_category = CategoryProduct::findOrFail($id);
        // cek apakah ada produk yang menggunakan kategori ini
        $products = $get_category->product()->get();
        if ($products->count() > 0) {
            return redirect()->route('manage-produk.index')->with('error_delete_categoryproduct', 'Kategori produk ini tidak dapat dihapus karena saat ini masih digunakan oleh beberapa produk');
        }
        // jika tidak ada produk yang menggunakan kategori ini, maka hapus kategori
        $get_category->delete();
        return redirect()->route('manage-produk.index')->with('success_delete_categoryproduct', 'Data berhasil dihapus');
    }
}
