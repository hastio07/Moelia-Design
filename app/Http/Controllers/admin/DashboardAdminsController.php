<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Jadwal;
use App\Models\ManagePesanan;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Service;
use App\Models\Video;

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
        $jumlahLayanan = Service::count();
        $managePesanan = ManagePesanan::count();
        $jadwal = Jadwal::get();

        return view('admin.Dashboard', compact('jumlahProduk', 'jumlahPegawai', 'jumlahPhoto', 'jumlahVideo', 'jumlahJadwal', 'jumlahLayanan', 'jadwal', 'managePesanan'));

    }
}
