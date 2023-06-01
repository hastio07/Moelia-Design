<?php

namespace App\Http\Controllers;

class DashboardAdminsController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }
}
