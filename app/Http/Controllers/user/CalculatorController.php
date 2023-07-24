<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\CalAllIn;
use App\Models\CategoryCustomVenue;
use App\Models\CategoryAdditionalVenue;
use App\Models\Product;
use App\Models\Contact;

class CalculatorController extends Controller
{
    public function index()
    {
        $calallin = CalAllIn::get();
        $categorycustomvenue = CategoryCustomVenue::with('customvenue')->get();
        $categoryadditionalvenue = CategoryAdditionalVenue::with('additionalvenue')->get();
        $products = Product::with('category_products')->latest()->paginate($perPage = 2, $columns = ['*']);
        $contacts = Contact::first();
        return view('user.WeddingCalculator', compact('products', 'calallin', 'categorycustomvenue', 'categoryadditionalvenue'));
    }
}
