<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ManageJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $get_jadwal = Jadwal::orderBy('updated_at', 'desc')->get();
            return DataTables::of($get_jadwal)->addIndexColumn()->addColumn('nama', function ($e) {
                return $e->nama;
            })->addColumn('kegiatan', function ($e) {
                return Str::limit($e->kegiatan, 20);
            })->addColumn('lokasi', function ($e) {
                return htmlspecialchars(Str::limit($e->lokasi, 20)); // menghindari interpretasi HTML pada data yang dikembalikan oleh callback.
            })->addColumn('jam', function ($e) {
                return $e->waktu->format('H:i');
            })->addColumn('tanggal', function ($e) {
                return $e->waktu->format('d-m-Y');
            })->addColumn('aksi', function ($e) {
                $json = htmlspecialchars(json_encode($e), ENT_QUOTES, 'UTF-8');

                return '<div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                <button class="btn btn-warning" data-bs-jadwal="' . $json . '" data-bs-route="' . route('manage-jadwal.update', $e->id) . '" data-bs-target="#jadwalModal" data-bs-toggle="modal" id="edit-button" type="button"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger" data-bs-route="' . route('manage-jadwal.destroy', $e->id) . '" data-bs-target="#jadwalModal" data-bs-toggle="modal" id="delete-button" type="button"><i class="bi bi-trash"></i></button>
                                            </div>';
            })->rawColumns(['nama', 'kegiatan', 'lokasi', 'jam', 'tanggal', 'aksi'])->make();
        }
        return view('dashboard.admin.ManageJadwal');
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
            'nama' => 'required',
            'kegiatan' => 'required',
            'lokasi' => 'required',
            'jam' => 'required',
            'tanggal' => 'required',
        ];
        $massages = [
            'nama.required' => "Nama Customer Wajib Diisi",
            'Kegiatan.required' => "Kegiatan Wajib Diisi",
            'lokasi.required' => "Lokasi Wajib Diisi",
            'jam.required' => "Jam Wajib Diisi",
            'tanggal.required' => "Tanggal Wajib Diisi",
        ];
        $validator = Validator::make($request->all(), $rules, $massages);
        $validatedData = $validator->validated();
        $nama = $validatedData['nama'];
        $kegiatan = $validatedData['kegiatan'];
        $lokasi = $validatedData['lokasi'];
        $tanggal = $validatedData['tanggal'];
        $jam = $validatedData['jam'];
        if ($validator->fails()) {
            return back()->with('failed_add_account', 'gagal menambahkan akun')->withErrors($validator)->withInput();
        }
        $unix = strtotime("$tanggal $jam");
        $combinedDT = date('Y-m-d H:i:s', $unix);

        $data = [
            'nama' => $nama,
            'kegiatan' => $kegiatan,
            'lokasi' => $lokasi,
            'waktu' => $combinedDT,
        ];

        Jadwal::create($data);
        return redirect()->route('manage-jadwal.index')->with('success', 'Data Berhasil Ditambahkan!');
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
            'nama' => 'required',
            'kegiatan' => 'required',
            'lokasi' => 'required',
            'jam' => 'required',
            'tanggal' => 'required',
        ];
        $massages = [
            'nama.required' => "Nama Customer Wajib Diisi",
            'Kegiatan.required' => "Kegiatan Wajib Diisi",
            'lokasi.required' => "Lokasi Wajib Diisi",
            'jam.required' => "Jam Wajib Diisi",
            'tanggal.required' => "Tanggal Wajib Diisi",
        ];
        $validator = Validator::make($request->all(), $rules, $massages);
        $validatedData = $validator->validated();
        $nama = $validatedData['nama'];
        $kegiatan = $validatedData['kegiatan'];
        $lokasi = $validatedData['lokasi'];
        $tanggal = $validatedData['tanggal'];
        $jam = $validatedData['jam'];
        if ($validator->fails()) {
            return back()->with('failed_add_account', 'gagal menambahkan akun')->withErrors($validator)->withInput();
        }
        $unix = strtotime("$tanggal $jam");
        $combinedDT = date('Y-m-d H:i:s', $unix);

        $data = [
            'nama' => $nama,
            'kegiatan' => $kegiatan,
            'lokasi' => $lokasi,
            'waktu' => $combinedDT,
        ];

        Jadwal::where('id', $id)->update($data);
        return redirect()->route('manage-jadwal.index')->with('success', 'Data Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Jadwal::findOrFail($id);
        $value->delete();
        return redirect()->route('manage-jadwal.index')->with('success', 'Data Berhasil DiHapus!');
    }
}
