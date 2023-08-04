<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ManagePesanan;

class CetakKontrakController extends Controller
{
    //
    public function index($email)
    {

        $ManagePesanan = ManagePesanan::where('email_pemesan',$email)->first();
        return view('admin.CetakKontrak', compact('ManagePesanan'));
    }
}
