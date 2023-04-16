<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Company;
use App\Models\Photo;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function index()
    {
        $galleries = Photo::inRandomOrder()->limit(3)->get();
        $photos = Photo::limit(6)->get();
        $products = Product::with('category')->limit(3)->get();
        $addresses = Address::first();
        $companies = Company::first();
        return view('dashboard.user.home', compact('galleries', 'photos', 'products', 'addresses', 'companies'));
    }
}
