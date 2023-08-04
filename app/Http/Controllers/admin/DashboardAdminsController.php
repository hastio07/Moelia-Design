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
use Illuminate\Support\Facades\DB;

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

        //untuk menjumlahkan pesanan baru/proses
        $results = ManagePesanan::select('email_pemesan', DB::raw('COUNT(DISTINCT email_pemesan) as count'))->groupBy('email_pemesan')->get();
        $managePesanan = $results->count();

        //untuk menjumlahkan pesanan selesai
        $resultsII = ManagePesanan::select('email_pemesan', DB::raw('COUNT(*) as count'))
            ->whereNotNull('waktu_pembayaran')
            ->whereNotNull('tanggal_konfirmasi')
            ->groupBy('email_pemesan')
            ->get();
        $managePesananSelesai = $resultsII->count();

        $jadwal = Jadwal::get();


        return view('admin.Dashboard', compact('jumlahProduk', 'jumlahPegawai', 'jumlahPhoto', 'jumlahVideo', 'jumlahJadwal', 'jumlahLayanan', 'jadwal', 'managePesanan','managePesananSelesai'));

    }
}
