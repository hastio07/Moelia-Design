<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as ImageResize;
use Yajra\DataTables\Facades\DataTables;

class ManageLayananController extends Controller
{

    private function renderDataTables($data)
    {
        return DataTables::eloquent($data)
            ->editColumn('gambar', function ($value) {
                if ($value->gambar) {
                    return '<img alt="' . $value->tipe_layanan . '" height="150" src="/storage/compressed/' . $value->gambar . '" width="180">';
                } else {
                    return '<img alt="' . $value->tipe_layanan . '" height="150" src="https://dummyimage.com/180x150.png" width="180">';
                }
            })
            ->editColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button class="btn btn-warning" data-bs-barang="' . $json . '" data-bs-route="' . route('manage-gudang.update', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger" data-bs-route="' . route('manage-gudang.destroy', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                </div>';
            })->filter(function ($query) {
            if (request()->has('search') && !empty(request()->get('search')['value'])) {
                $searchValue = request()->get('search')['value'];
                $query->where('tipe_layanan', 'LIKE', "%$searchValue%")
                    ->orWhere('deskripsi', 'LIKE', "%$searchValue%");
            }
        })
            ->rawColumns(['gambar', 'aksi'])
            ->make(true);
    }

    public function index()
    {
        if (request()->ajax()) {

            $service = Service::query();

            if (request()->has('order') && !empty(request()->input('order'))) {
                $order = request()->input('order')[0];
                $columnIndex = $order['column'];
                $columnName = request()->input('columns')[$columnIndex]['data'];
                $columnDirection = $order['dir'];
                $service->orderBy($columnName, $columnDirection);
            } else {
                $service->latest('updated_at');
            }

            return $this->renderDataTables($service);
        }

        return view('admin.managelayanan');
    }

    public function store(Request $request)
    {
        $rules = [
            'tipe_layanan' => 'required|string|max:255',
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
            'tipe_layanan' => $validatedData['tipe_layanan'],
            'deskripsi' => $validatedData['deskripsi'],
        ];
        //Simpan gambar ke file storage/app/public
        if ($request->hasFile('gambar')) {

            $oriPath = $request->file('gambar')->store('service-images'); // -> service-images/<nama_files.ext>
            $fileName = basename($oriPath);

            // kompres gambar dan simpan ke folder penyimpanan
            $thumbImage = ImageResize::make(storage_path('app/public/' . $oriPath));
            $thumbPath = storage_path('app/public/compressed/' . $fileName);
            $thumbImage->save($thumbPath, 20);
            $data['gambar'] = $fileName;
        }
        //Simpan layanan
        Service::create($data);

        return redirect()->route('manage-layanan.index')->with('success', 'data berhasil disimpan');

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'tipe_layanan' => 'required|string|max:255',
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

        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'tipe_layanan' => $validatedData['tipe_layanan'],
            'deskripsi' => $validatedData['deskripsi'],
        ];

        //Simpan gambar ke file storage/app/public
        if ($request->hasFile('gambar')) {
            if ($request->input('oldImage')) {
                Storage::delete(['compressed/' . $request->input('oldImage'), 'service-images/' . $request->input('oldImage')]);
            }
            $oriPath = $request->file('gambar')->store('service-images'); // -> service-images/<nama_files.ext>
            $fileName = basename($oriPath);
            // kompres gambar dan simpan ke folder penyimpanan
            $thumbImage = ImageResize::make(storage_path('app/public/' . $oriPath));
            $thumbPath = storage_path('app/public/compressed/' . $fileName);
            $thumbImage->save($thumbPath, 20);
            $data['gambar'] = $fileName;
        }
        //Simpan produk
        Service::where('id', $id)->update($data);

        return redirect()->route('manage-layanan.index')->with('success', 'data berhasil diubah');

    }

    public function destroy($id)
    {
        $cek = Service::findOrFail($id);

        if ($cek->gambar) {
            $path = $cek->gambar;
            Storage::delete(['compressed/' . $path, 'service-images/' . $path]);
        }
        Service::destroy($id);
        return redirect()->route('manage-layanan.index')->with('success', 'Data Berhasil DiHapus!');

    }
}
