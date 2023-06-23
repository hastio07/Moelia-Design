<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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

            $jadwal = Jadwal::query();

            if (request()->has('order') && !empty(request()->input('order'))) {
                $order = request()->input('order')[0];
                $columnIndex = $order['column'];
                $columnName = request()->input('columns')[$columnIndex]['data'];
                $columnDirection = $order['dir'];

                if ($columnName == 'tanggal') {
                    $jadwal->orderByRaw('DATE_FORMAT(waktu, "%Y-%m-%d") ' . $columnDirection);
                } elseif ($columnName == 'jam') {
                    $jadwal->orderByRaw('DATE_FORMAT(waktu, "%H:%i") ' . $columnDirection);
                } else {
                    $jadwal->orderBy($columnName, $columnDirection);
                }
            } else {
                $jadwal->orderBy('updated_at', 'desc');
            }

            return DataTables::eloquent($jadwal)->editColumn('kegiatan', function ($value) {
                return Str::limit($value->kegiatan, 20);
            })->editColumn('lokasi', function ($value) {
                return htmlspecialchars(Str::limit($value->lokasi, 20)); // menghindari interpretasi HTML pada data yang dikembalikan oleh callback.
            })->addColumn('jam', function ($value) {
                return $value->waktu->format('H:i');
            })->addColumn('tanggal', function ($value) {
                return $value->waktu->format('d-m-Y');
            })->addColumn('aksi', function ($value) {
                $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');
                return '<div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                <button class="btn btn-warning" data-bs-jadwal="' . $json . '" data-bs-route="' . route('manage-jadwal.update', $value->id) . '" data-bs-target="#jadwalModal" data-bs-toggle="modal" id="edit-button" type="button"><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-danger" data-bs-route="' . route('manage-jadwal.destroy', $value->id) . '" data-bs-target="#jadwalModal" data-bs-toggle="modal" id="delete-button" type="button"><i class="bi bi-trash"></i></button>
                                            </div>';
            })->filter(function ($query) {
                if (request()->has('search') && !empty(request()->get('search')['value'])) {
                    $searchValue = request()->get('search')['value'];
                    $query->where('nama', 'LIKE', "%$searchValue%")
                        ->orWhere('kegiatan', 'LIKE', "%$searchValue%")
                        ->orWhere('lokasi', 'LIKE', "%$searchValue%")
                        ->orWhereRaw("DATE_FORMAT(waktu, '%H:%i') LIKE ? ", ["%$searchValue%"])
                        ->orwhereRaw("DATE_FORMAT(waktu, '%d-%m-%Y') LIKE ?", ["%$searchValue%"]);
                }
            })->rawColumns(['aksi'])->make(true);
        }
        return view('admin.ManageJadwal');
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
            'nama.required' => ":Attribute Customer Wajib Diisi",
            'kegiatan.required' => ":Attribute Wajib Diisi",
            'lokasi.required' => ":Attribute Wajib Diisi",
            'jam.required' => ":Attribute Wajib Diisi",
            'tanggal.required' => ":Attribute Wajib Diisi",
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

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($data);

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
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('manage-jadwal.index')->with('success', 'Data Berhasil DiHapus!');
    }
}
