<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class StrukController extends Controller
{
    public function index()
    {
        $data = [
            [
                'no_referensi' => '571234568987655',
                'tgl_pembayaran' => '22/04/2024',
                'waktu_pembayaran' => '13:05:31 WIB',
                'no_va' => '0777 8907 32',
                'nama' => 'Muhammad Ardi',
                'total_bayar' => 'Rp 10.000.000',
                'biaya_admin' => 'Rp 5.000',
                'total_bayar_final' => 'Rp 10.00.5000',
                'rekening_debet' => '**** 1362',
            ],
        ];
        return view('user.Struk', compact('data'));
    }

    public function cetakStruk()
    {
        $data = [
            [
                'no_referensi' => '571234568987655',
                'tgl_pembayaran' => '22/04/2024',
                'waktu_pembayaran' => '13:05:31 WIB',
                'no_va' => '0777 8907 32',
                'nama' => 'Muhammad Ardi',
                'total_bayar' => 'Rp 10.000.000',
                'biaya_admin' => 'Rp 5.000',
                'total_bayar_final' => 'Rp 10.00.5000',
                'rekening_debet' => '**** 1362',
            ],
        ];

        //$pdf = Pdf::loadView('user.struk', ['data' => $data]);
        // return $pdf->download('struk_pembayaran.pdf');
    }
}
