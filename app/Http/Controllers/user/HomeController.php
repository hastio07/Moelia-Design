<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Service;
use App\Models\About;
use App\Models\VideoPromosi;

class HomeController extends Controller
{
    //
    public function index()
    {
        $galleries = Photo::inRandomOrder()->limit(3)->latest()->get();
        $photos = Photo::limit(8)->latest()->get();
        $products = Product::with('category_products')->limit(3)->latest()->get();
        $services = Service::latest()->get();
        $companies = Company::first();
        $abouts = About::first();
        $videopromosi = VideoPromosi::first();

        return view('user.Home', compact('galleries', 'photos', 'products', 'services', 'companies', 'abouts', 'videopromosi'));
    }
}
