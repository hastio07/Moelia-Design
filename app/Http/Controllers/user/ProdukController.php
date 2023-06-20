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

    public function sortProducts($sort)
    {
        $products = null;

        if ($sort === 'harga-tertinggi') {
            $products = Product::orderBy('harga_sewa', 'desc')->paginate(4);
        } elseif ($sort === 'harga-terendah') {
            $products = Product::orderBy('harga_sewa')->paginate(4);
        } elseif ($sort === 'kategori') {
            $products = Product::with('category_products')
                ->orderBy('kategori_id', 'desc')
                ->paginate(4);
        } elseif ($sort === 'tanggal') {
            $products = Product::orderBy('created_at', 'desc')->paginate(4);
        }

        // Mengirim data produk yang telah disortir ke tampilan
        return view('user.Produk', compact('products'));
    }
}
