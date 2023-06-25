<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;

class DashboardAdminsController extends Controller
{
    //
    public function index()
    {

        $jadwal= Jadwal::get();

        return view('admin.dashboard', compact('jadwal'));

    }
}
