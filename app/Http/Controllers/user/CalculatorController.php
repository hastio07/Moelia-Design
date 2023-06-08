<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CalculatorController extends Controller
{
    public function index()
    {
        $products = Product::with('category_products')->latest()->paginate($perPage = 2, $columns = ['*']);
        return view('user.WeddingCalculator', compact('products'));
    }
}
