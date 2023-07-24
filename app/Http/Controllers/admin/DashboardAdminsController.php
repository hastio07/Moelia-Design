<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Product;
use App\Models\Employee;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Service;

class DashboardAdminsController extends Controller
{
    //
    public function index()
    {
        $jumlahPegawai = Employee::count();
        $jumlahProduk = Product::count();
        $jumlahPhoto = Photo::count();
        $jumlahVideo = Video::count();
        $jumlahJadwal = Jadwal::count();
        $jumlahLayanan = Service :: count();
        $jadwal = Jadwal::get();

        return view('admin.Dashboard', compact('jumlahProduk','jumlahPegawai','jumlahPhoto','jumlahVideo','jumlahJadwal','jumlahLayanan', 'jadwal'));

    }
}
