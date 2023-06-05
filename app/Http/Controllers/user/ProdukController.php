<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Product::with('category_products')->latest()->paginate($perPage = 4, $columns = ['*']);
        return view('user.produk', compact('products'));
    }

    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('user.detailitem', compact('products'));
    }
}
