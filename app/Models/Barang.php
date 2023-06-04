<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = "barangs";
    protected $primaryKey = "id";
    protected $fillable = ['nama_barang', 'kategori_id', 'stok'];

    /**
     * Relasi database table barangs ke table category_barangs (one-to-many (invers))
     */
    public function categorybarang()
    {
        return $this->belongsTo(CategoryBarang::class, 'kategori_id', 'id');
    }
}
