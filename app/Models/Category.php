<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $tabel = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_kategori', 'slug_kategori'];
    protected $hidden = ['id'];

    /**
     * Relasi database table categories ke table products (one-to-many)
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'kategori_id', 'id');
    }
}
