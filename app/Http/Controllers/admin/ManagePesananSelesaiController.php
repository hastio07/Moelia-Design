<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ManagePesanan;
use Illuminate\Http\Request;

class ManagePesananSelesaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $list_pesanan = ManagePesanan::where('status', 'paid')->whereNotNull('tanggal_konfirmasi');
            return datatables()->of($list_pesanan)
                ->editColumn('nama_pemesan', function ($value) {
                    return '<a href="' . route('manage-pesanan-selesai.detail', $value->id_hash_format) . '">' . $value->nama_pemesan . '</a>';
                })
                ->editColumn('telepon_pemesan', function ($value) {
                    return $value->telepon_pemesan;
                })
                ->editColumn('tanggal_akad_dan_resepsi', function ($value) {
                    return \Carbon\Carbon::parse($value->tanggal_akad_dan_resepsi)->format('l/d-m-Y');
                })
                ->addColumn('status_konfirmasi', function ($value) {
                    return $value->status_konfirmasi;
                })->editColumn('status', function ($value) {
                    if ($value->status === 'paid') {
                        return '<i class="bi bi-check2-square text-success"></i> Dibayar';
                    }
                })->addColumn('aksi', function ($value) {
                    return '<button class="btn btn-danger" data-bs-route="' . route('manage-pesanan-selesai.destroy', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>';
                })->rawColumns(['nama_pemesan', 'status', 'aksi'])->make(true);
        }

        return view('admin.ManagePesananSelesai');
    }

    public function detail(ManagePesanan $data, Request $request)
    {
        auth()->user()->unreadNotifications->where('id', $request->get('ntf'))->first()?->markAsRead();
        return view('admin.DetailPesanan', compact('data'));
    }

    public function destroy(ManagePesanan $order_id)
    {
        if ($order_id->status != 'paid' && $order_id->jenis_pembayaran === 'dp') {
            // Jika status cancel, expire, unpaid dan jenis bayar dp
            // Jika dp dihapus maka fp jg ikut dihapus
            $order_id->delete();
            return redirect()->route('manage-pesanan-proses.index')->with('success_delete_pesanan', 'Pesanan berhasil dihapus');
        }
        // Jika status sudah paid, pending
        return redirect()->route('manage-pesanan-proses.index')->with('error_delete_pesanan', 'Pesanan ini gagal dihapus karena sudah dibayar');
    }
}
