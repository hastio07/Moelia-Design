<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ManageJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_jadwal = jadwal::get();
        return view('dashboard.admin.ManageJadwal', compact('data_jadwal'));
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
        Session::flash('nama', $request->nama);
        Session::flash('kegiatan', $request->kegiatan);
        Session::flash('lokasi', $request->lokasi);
        Session::flash('jam', $request->jam);
        Session::flash('tanggal', $request->tanggal);

        $request->validate([
            'nama' => 'required',
            'kegiatan' => 'required',
            'lokasi' => 'required',
            'jam' => 'required',
            'tanggal' => 'required',
        ], [
            'nama.required' => "Nama Customer Wajib Diisi",
            'Kegiatan.required' => "Kegiatan Wajib Diisi",
            'lokasi.required' => "Lokasi Wajib Diisi",
            'jam.required' => "Jam Wajib Diisi",
            'tanggal.required' => "Tanggal Wajib Diisi",
        ]);
        $data = [
            'nama' => $request->nama,
            'kegiatan' => $request->kegiatan,
            'lokasi' => $request->lokasi,
            'jam' => $request->jam,
            'tanggal' => $request->tanggal,
        ];
        jadwal::create($data);
        return redirect('/managejadwal')->with('success', 'Data Berhasil Ditambahkan!');
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
        $value = jadwal::findOrFail($id);
        $value->delete();
        return redirect('/managejadwal')->with('success', 'Data Berhasil DiHapus!');
    }
}
