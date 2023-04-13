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
    ];

    protected $hidden = [
        'id',
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
     * Relasi database table products ke table categories (one-to-many (invers))
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }

}
