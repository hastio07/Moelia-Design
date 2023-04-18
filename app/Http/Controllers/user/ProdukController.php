<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProdukController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate($perPage = 4, $columns = ['*']);
        return view('dashboard.user.produk', compact('products'));
    }

    public function show($id)
    {
        $products = Product::findOrFail($id);
        return view('dashboard.user.detailitem', compact('products'));
    }
}
