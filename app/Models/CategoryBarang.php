<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBarang extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'category_barangs';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kategori_barang', 'slug_kategori'];

    public function sluggable(): array
    {
        return [
            'slug_kategori' => [
                'source' => 'nama_kategori_barang',
            ],
        ];
    }

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id', 'id');
    }
}
