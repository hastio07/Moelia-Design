<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasFormatRupiah, Sluggable;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'created_by',
        'nama_produk',
        'slug_produk',
        'kategori_id',
        'harga_sewa',
        'rincian_produk',
        'deskripsi',
        'gambar',
        'album_produk',
    ];

    public function sluggable(): array
    {
        return [
            'slug_produk' => [
                'source' => 'nama_produk',
            ],
        ];
    }

    /**
     * Relasi database table products ke table category_products (one-to-many (invers))
     */
    public function category_products()
    {
        return $this->belongsTo(CategoryProduct::class, 'kategori_id', 'id');
    }

}
