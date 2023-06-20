<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePesananProsesController extends Controller
{
    public function index(Request $request)
    {
        /* if ($request->ajax()) {
        //Jika request from_date ada value(datanya) maka
        if (!empty($request->from_date)) {
        //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
        if ($request->from_date === $request->to_date) {
        //kita filter tanggalnya sesuai dengan request from_date
        / $list_pegawai = OrderProcess::whereDate('created_at', '=', $request->from_date)->get();
        } else {
        //kita filter dari tanggal awal ke akhir
        $list_pegawai = OrderProcess::whereBetween('created_at', array($request->from_date, $request->to_date))->get();
        }
        }
        $list_order_processing = OrderProcess::all();
        return datatables()->of($list_order_processing)
        ->rawColumns(['Aksi'])
        ->make(true);
        }
         */
        return view('admin.managepesananproses');
    }
}
