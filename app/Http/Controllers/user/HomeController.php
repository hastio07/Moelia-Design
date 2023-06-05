<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Company;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Service;

class HomeController extends Controller
{
    //
    public function index()
    {
        $galleries = Photo::inRandomOrder()->limit(3)->latest()->get();
        $photos = Photo::limit(6)->latest()->get();
        $products = Product::with('category_products')->limit(3)->latest()->get();
        $addresses = Address::first();
        $services = Service::latest()->get();
        $companies = Company::first();
        return view('user.home', compact('galleries', 'photos', 'products', 'addresses', 'services', 'companies'));
    }
}
