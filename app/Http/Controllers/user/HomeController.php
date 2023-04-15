<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;

class HomeController extends Controller
{
    //
    public function index()
    {
        $companies = Company::first();
        return view('dashboard.user.home', compact('companies'));
    }
}
