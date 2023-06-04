<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['nama_kategori', 'slug_kategori'];
    protected $primaryKey = 'id';
    public function sluggable(): array
    {
        return [
            'slug_kategori' => [
                'source' => 'nama_kategori',
            ],
        ];
    }
    /**
     * Relasi database table category_products ke table products (one-to-many)
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'kategori_id', 'id');
    }
}
