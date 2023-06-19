<?php

namespace App\Http\Controllers\user;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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

    public function search(Request $request)
    {
        $searchInput = $request->input('searchInput');
        $products = Product::where(function ($query) use ($searchInput) {
            $query->where('nama_produk', 'like', '%' . $searchInput . '%')
                ->orWhereHas('category_products', function ($query) use ($searchInput) {
                    $query->where('nama_kategori', 'like', '%' . $searchInput . '%');
                })
                ->orWhere('harga_sewa', 'like', '%' . $searchInput . '%');
        })->paginate(10);

        return view('user.Produk', compact('products', 'searchInput'));
    }
}
