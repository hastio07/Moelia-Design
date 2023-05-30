<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesBarang extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['nama_kategori_barang', 'slug_kategori'];
    protected $table = 'categories_barang';
    protected $primaryKey = 'id';
    public function sluggable(): array
    {
        return [
            'slug_kategori' => [
                'source' => 'nama_kategori_barang'
            ],
        ];
    }

    public function gudang()
    {
        return $this->hasMany(Gudang::class, 'kategori_id', 'id');
    }
}
