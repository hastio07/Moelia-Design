<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image as ImageResize;

class ManageLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
        return view('dashboard.admin.managelayanan', compact('services'));
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

        return redirect('dashboard/manage-layanan')->with('success', 'data berhasil disimpan');

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

        return redirect('dashboard/manage-layanan')->with('success', 'data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Service::findOrFail($id);

        if ($cek->gambar) {
            $path = $cek->gambar;
            Storage::delete(['compressed/' . $path, 'service-images/' . $path]);
        }
        Service::destroy($id);
        return redirect('/dashboard/manage-layanan')->with('success', 'Data Berhasil DiHapus!');

    }
}
