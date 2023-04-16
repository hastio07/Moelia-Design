<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Photo;

class HomeController extends Controller
{
    //
    public function index()
    {
        $companies = Company::first();
        $galleries = Photo::inRandomOrder()->limit(3)->get();
        $photos = Photo::all('photo_name', 'photo_path');
        return view('dashboard.user.home', compact('companies', 'galleries', 'photos'));
    }
}
