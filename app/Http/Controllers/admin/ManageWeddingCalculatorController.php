<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CalAdditionalVenue;
use App\Models\CalAllIn;
use App\Models\CalCustomVenue;
use App\Models\CategoryAdditionalVenue;
use App\Models\CategoryCustomVenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManageWeddingCalculatorController extends Controller
{
    public function index()
    {
        return view('admin.ManageWeddingCalculator');
    }

    public function getAllIn()
    {
        if (request()->ajax()) {
            $paketAllIn = CalAllIn::orderBy('updated_at', 'desc');
            return DataTables::eloquent($paketAllIn)->editColumn('harga', function ($value) {
                return $value->formatRupiah('harga');
            })->addColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button class="btn btn-warning" data-bs-name="All-In" data-bs-paket="' . $json . '" data-bs-route="' . route('manage-wedding-calculator.uatAllIn', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger" data-bs-route="' . route('manage-wedding-calculator.dAllIn', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                         </div>';
            })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where('nama_paket', 'LIKE', "%$searchValue%")->orWhere('harga', 'LIKE', "%$searchValue%");

                }
            })->rawColumns(['aksi'])->make(true);
        }

    }

    public function getCustomVenue()
    {
        if (request()->ajax()) {
            $paketCustomVenue = CalCustomVenue::with('categorycustomvenue')->orderBy('updated_at', 'desc');
            return DataTables::eloquent($paketCustomVenue)->editColumn('kategori_id', function ($value) {
                return $value->categorycustomvenue->nama;
            })->editColumn('harga', function ($value) {
                return $value->formatRupiah('harga');
            })->addColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button class="btn btn-warning"  data-bs-category="' . route('manage-wedding-calculator.dataCategoryCustomVenue') . '" data-bs-name="Custom Venue"  data-bs-paket="' . $json . '" data-bs-route="' . route('manage-wedding-calculator.uatCustomVenue', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger" data-bs-route="' . route('manage-wedding-calculator.dCustomVenue', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                         </div>';
            })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where('nama_paket', 'LIKE', "%$searchValue%")->orWhereHas('categorycustomvenue', function ($query) use ($searchValue) {
                        $query->where('nama', 'LIKE', "%$searchValue%");
                    })->orWhere('harga', 'LIKE', "%$searchValue%");
                }
            })->rawColumns(['aksi'])->make(true);

        }

    }
    public function getAdditionalVenue()
    {
        if (request()->ajax()) {
            $paketAdditionalVenue = CalAdditionalVenue::with('categoryadditionalvenue')->orderBy('updated_at', 'desc');
            return DataTables::eloquent($paketAdditionalVenue)->editColumn('kategori_id', function ($value) {
                return $value->categoryadditionalvenue->nama;
            })->editColumn('harga', function ($value) {
                return $value->formatRupiah('harga');
            })->addColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return ' <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <button class="btn btn-warning"  data-bs-category="' . route('manage-wedding-calculator.dataCategoryAdditionalVenue') . '" data-bs-name="Additional Venue"  data-bs-paket="' . $json . '" data-bs-route="' . route('manage-wedding-calculator.uatAdditionalVenue', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger" data-bs-route="' . route('manage-wedding-calculator.dAdditionalVenue', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                         </div>';
            })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where('nama_paket', 'LIKE', "%$searchValue%")->orWhereHas('categoryadditionalvenue', function ($query) use ($searchValue) {
                        $query->where('nama', 'LIKE', "%$searchValue%");
                    })->orWhere('harga', 'LIKE', "%$searchValue%");
                }
            })->rawColumns(['aksi'])->make(true);

        }
    }

    public function catAllIn(Request $request)
    {

        $rules = [
            'nama-paket-allin' => 'required|string|max:255',
            'harga-paket-allin' => 'required|numeric|integer|max:9999999999',
        ];
        $massages = [
            'nama-paket-allin.required' => 'Nama paket :attribute wajib diisi.',
            'nama-paket-allin.max' => 'Nama paket :attribute melebihi panjang maksimum yang diizinkan',
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-allin.numeric' => ':attribute harus dalam format numerik.',
        ];
        $customAttributes = [
            'nama-paket-allin' => 'All-In',
            'harga-paket-allin' => 'Harga',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_paket_allin', 'Gagal menambahkan paket All-In'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-allin'],
            'harga' => (int) $validatedData['harga-paket-allin'],
        ];

        //Simpan paket allin
        CalAllIn::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_paket_allin', 'Paket All-In berhasil disimpan');
    }

    public function catCustomVenue(Request $request)
    {

        $rules = [
            'nama-paket-customvenue' => 'required|string|max:255',
            'harga-paket-customvenue' => 'required|numeric|integer|max:9999999999',
            'kategori-customvenue' => 'required|integer|max:255',
        ];
        $massages = [
            'nama-paket-customvenue.required' => 'Nama paket :attribute wajib diisi.',
            'nama-paket-customvenue.max' => 'Nama paket :attribute melebihi panjang maksimum yang diizinkan',
            'kategori-customvenue.required' => 'Kategori paket :attribute wajib diisi.',
            'kategori-customvenue.integer' => 'Kategori :attribute harus berupa bilangan bulat.',
            'kategori-customvenue.max' => 'Kategori :attribute melebihi panjang maksimum yang diizinkan',
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-customvenue.numeric' => ':attribute harus dalam format numerik.',
        ];
        $customAttributes = [
            'nama-paket-customvenue' => 'Custom Venue',
            'harga-paket-customvenue' => 'Harga',
            'kategori-customvenue' => 'Custom Venue',
        ];

        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_paket_customvenue', 'Gagal menambahkan paket Custom Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-customvenue'],
            'harga' => (int) $validatedData['harga-paket-customvenue'],
        ];

        if ($validatedData['kategori-customvenue']) {
            $data['kategori_id'] = (int) $validatedData['kategori-customvenue'];
        }

        //Simpan paket custom venue
        CalCustomVenue::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_paket_customvenue', 'Paket Custom Venue berhasil disimpan');
    }

    public function catAdditionalVenue(Request $request)
    {

        $rules = [
            'nama-paket-additionalvenue' => 'required|string|max:255',
            'harga-paket-additionalvenue' => 'required|numeric|integer|max:9999999999',
            'kategori-additionalvenue' => 'required|integer|max:255',
        ];
        $massages = [
            'nama-paket-additionalvenue.required' => 'Paket :attribute wajib diisi.',
            'nama-paket-additionalvenue.max' => 'Nama paket :attribute melebihi panjang maksimum yang diizinkan',
            'kategori-additionalvenue.required' => 'Kategori paket :attribute wajib diisi.',
            'kategori-additionalvenue.integer' => 'Kategori :attribute harus berupa bilangan bulat.',
            'kategori-additionalvenue.max' => 'Kategori :attribute melebihi panjang maksimum yang diizinkan',
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-additionalvenue.numeric' => ':attribute harus dalam format numerik.',
        ];
        $customAttributes = [
            'nama-paket-additionalvenue' => 'Additional Venue',
            'harga-paket-additionalvenue' => 'Harga',
            'kategori-additionalvenue' => 'Additional Venue',
        ];

        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_paket_additionalvenue', 'Gagal menambahkan paket Additional Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-additionalvenue'],
            'harga' => (int) $validatedData['harga-paket-additionalvenue'],
        ];
        if ($validatedData['kategori-additionalvenue']) {
            $data['kategori_id'] = (int) $validatedData['kategori-additionalvenue'];
        }

        //Simpan paket custom paket
        CalAdditionalVenue::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_paket_additionalvenue', 'Item berhasil ditambahkan');
    }

    public function uatAllIn(Request $request, $id)
    {
        $rules = [
            'nama-paket-allin' => 'required|string|max:255',
            'harga-paket-allin' => 'required|numeric|integer|max:9999999999',
        ];
        $massages = [
            'nama-paket-allin.required' => 'Paket :attribute wajib diisi.',
            'nama-paket-allin.max' => 'Nama paket :attribute melebihi panjang maksimum yang diizinkan',
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-allin.numeric' => ':attribute harus dalam format numerik.',
        ];
        $customAttributes = [
            'nama-paket-allin' => 'All-In',
            'harga-paket-allin' => 'Harga',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_paket_allin', 'Gagal mengubah paket All-in'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-allin'],
            'harga' => (int) $validatedData['harga-paket-allin'],
        ];

        //Simpan paket allin
        $CalAllIn = CalAllIn::findOrFail($id);

        $CalAllIn->update($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_edit_paket_allin', 'Paket All-In berhasil diubah');
    }

    public function uatCustomVenue(Request $request, $id)
    {
        $rules = [
            'nama-paket-customvenue' => 'required|string|max:255',
            'harga-paket-customvenue' => 'required|numeric|integer|max:9999999999',
            'kategori-customvenue' => 'required|integer|max:255',
        ];
        $massages = [
            'nama-paket-customvenue.required' => 'Nama paket :attribute wajib diisi.',
            'nama-paket-customvenue.max' => 'Nama paket :attribute melebihi panjang maksimum yang diizinkan',
            'kategori-customvenue.required' => 'Kategori paket :attribute wajib diisi.',
            'kategori-customvenue.integer' => 'Kategori :attribute harus berupa bilangan bulat.',
            'kategori-customvenue.max' => 'Kategori :attribute melebihi panjang maksimum yang diizinkan',
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-customvenue.numeric' => ':attribute harus dalam format numerik.',
        ];
        $customAttributes = [
            'nama-paket-customvenue' => 'Custom Venue',
            'harga-paket-customvenue' => 'Harga',
            'kategori-customvenue' => 'Custom Venue',
        ];

        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_paket_customvenue', 'Gagal mengubah paket Custom Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-customvenue'],
            'harga' => (int) $validatedData['harga-paket-customvenue'],
        ];

        if ($validatedData['kategori-customvenue']) {
            $data['kategori_id'] = (int) $validatedData['kategori-customvenue'];
        }

        //Simpan paket custom venue
        $CalCustomVenue = CalCustomVenue::findOrFail($id);

        $CalCustomVenue->update($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_edit_paket_customvenue', 'Paket Custom Venue berhasil diubah');

    }
    public function uatAdditionalVenue(Request $request, $id)
    {
        $rules = [
            'nama-paket-additionalvenue' => 'required|string|max:255',
            'harga-paket-additionalvenue' => 'required|numeric|integer|max:9999999999',
            'kategori-additionalvenue' => 'required|integer|max:255',
        ];
        $massages = [
            'nama-paket-additionalvenue.required' => 'Paket :attribute wajib diisi.',
            'nama-paket-additionalvenue.max' => 'Nama paket :attribute melebihi panjang maksimum yang diizinkan',
            'kategori-additionalvenue.required' => 'Kategori paket :attribute wajib diisi.',
            'kategori-additionalvenue.integer' => 'Kategori :attribute harus berupa bilangan bulat.',
            'kategori-additionalvenue.max' => 'Kategori :attribute melebihi panjang maksimum yang diizinkan',
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-additionalvenue.numeric' => ':attribute harus dalam format numerik.',
        ];
        $customAttributes = [
            'nama-paket-additionalvenue' => 'Additional Venue',
            'harga-paket-additionalvenue' => 'Harga',
            'kategori-additionalvenue' => 'Additional Venue',
        ];

        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_paket_additionalvenue', 'Gagal mengubah paket Additional Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-additionalvenue'],
            'harga' => (int) $validatedData['harga-paket-additionalvenue'],
        ];

        if ($validatedData['kategori-additionalvenue']) {
            $data['kategori_id'] = (int) $validatedData['kategori-additionalvenue'];
        }

        //Simpan paket custom paket
        $CalAdditionalVenue = CalAdditionalVenue::findOrFail($id);

        $CalAdditionalVenue->update($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_edit_paket_additionalvenue', 'Paket Additional Venue berhasil diubah');
    }

    public function dAllIn($id)
    {
        $getPaketAllin = CalAllIn::findOrFail($id);
        if ($getPaketAllin) {
            $getPaketAllin->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_allin', 'Paket All-In berhasil dihapus');
        }

        // return back()->route('manage-wedding-calculator.index')->with('failed_delete_allin', 'Gagal dihapus paket All-In tidak ditemukan');
    }
    public function dCustomVenue($id)
    {
        $getCustomVenue = CalCustomVenue::findOrFail($id);
        if ($getCustomVenue) {
            $getCustomVenue->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_customvenue', 'Paket Custom Venue berhasil dihapus');
        }
        // return back()->route('manage-wedding-calculator.index')->with('failed_delete_customvenue', 'Gagal dihapus Custom Venue tidak ditemukan');
    }
    public function dAdditionalVenue($id)
    {
        $getPaketAdditionalVenue = CalAdditionalVenue::findOrFail($id);
        if ($getPaketAdditionalVenue) {
            $getPaketAdditionalVenue->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_additionalvenue', 'Paket Additional Venue berhasil dihapus');
        }
        // return back()->route('manage-wedding-calculator.index')->with('failed_delete_additionalvenue', 'Gagal dihapus paket Additional Venue tidak ditemukan');
    }

    // !!!!!!!! CATEGORY !!!!!!!! //
    public function getCategoryCustomVenue()
    {
        if (request()->ajax()) {
            $categoryCustomVenue = CategoryCustomVenue::orderBy('updated_at', 'desc');
            return DataTables::eloquent($categoryCustomVenue)->addColumn('aksi', function ($value) {
                return '<button class="btn text-danger" data-bs-route="' . route('manage-wedding-calculator.delCategoryCustomVenue', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>';
            })->rawColumns(['aksi'])->make(true);
        }
    }

    public function getCategoryAdditionalVenue()
    {
        if (request()->ajax()) {
            $categoryAdditionalVenue = CategoryAdditionalVenue::orderBy('updated_at', 'desc');
            return DataTables::eloquent($categoryAdditionalVenue)->addColumn('aksi', function ($value) {
                return '<button class="btn text-danger" data-bs-route="' . route('manage-wedding-calculator.delCategoryAdditionalVenue', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>';
            })->rawColumns(['aksi'])->make(true);
        }

    }

    public function catCategoryCustomVenue(Request $request)
    {
        $rules = [
            'nama-kategori-customvenue' => 'required|string|unique:category_custom_venues,nama|max:255',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'unique' => 'Kategori :attribute sudah ada',
        ];
        // Custom Attribute Name
        $customAttributes = [
            'nama-kategori-customvenue' => $request->input('nama-kategori-customvenue'),
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_category_paket_customvenue', 'Gagal menambahkan kategori paket Custom Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'nama' => $validatedData['nama-kategori-customvenue'],
        ];

        //Simpan paket custom venue
        CategoryCustomVenue::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_category_paket_customvenue', 'Kategori paket Custom Venue berhasil disimpan');

    }

    public function catCategoryAdditionalVenue(Request $request)
    {
        $rules = [
            'nama-kategori-additionalvenue' => 'required|string|unique:category_additional_venues,nama|max:255',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'unique' => 'Kategori :attribute sudah ada',
        ];
        // Custom Attribute Name
        $customAttributes = [
            'nama-kategori-additionalvenue' => $request->input('nama-kategori-additionalvenue'),
        ];

        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_category_paket_additionalvenue', 'Gagal menambahkan kategori paket Additional Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'nama' => $validatedData['nama-kategori-additionalvenue'],
        ];

        //Simpan paket custom paket
        CategoryAdditionalVenue::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_category_paket_additionalvenue', 'Kategori paket Additional Venue berhasil disimpan');
    }

    public function delCategoryCustomVenue($id)
    {
        $CategoryCustomVenue = CategoryCustomVenue::findOrFail($id);
        if ($CategoryCustomVenue) {
            $CustomVenue = $CategoryCustomVenue->customvenue()->get();
            if ($CustomVenue->count() > 0) {
                return redirect()->route('manage-wedding-calculator.index')->with('error_delete_category_customvenue', 'Kategori Custom Venue ini tidak dapat dihapus karena saat ini masih digunakan oleh beberapa paket Custom Venue');
            }
            $CategoryCustomVenue->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_category_customvenue', 'Kategori paket Custom Venue berhasil dihapus');
        }
    }
    public function delCategoryAdditionalVenue($id)
    {
        $CategoryAdditionalVenue = CategoryAdditionalVenue::findOrFail($id);
        if ($CategoryAdditionalVenue) {
            $AdditionalVenue = $CategoryAdditionalVenue->additionalvenue()->get();
            if ($AdditionalVenue->count() > 0) {
                return redirect()->route('manage-wedding-calculator.index')->with('error_delete_category_additionalvenue', 'Kategori Additional Venue ini tidak dapat dihapus karena saat ini masih digunakan oleh beberapa paket Additional Venue');
            }
            $CategoryAdditionalVenue->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_category_additionalvenue', 'Kategori paket Additional Venue berhasil dihapus');
        }
    }

    public function dataCategoryCustomVenue()
    {
        $categories = CategoryCustomVenue::all();

        return response()->json($categories);
    }

    public function dataCategoryAdditionalVenue()
    {
        $categories = CategoryAdditionalVenue::all();

        return response()->json($categories);
    }
}
