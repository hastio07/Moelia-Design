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

    public function categorybarang()
    {
        return $this->belongsTo(CategoryBarang::class, 'kategori_id', 'id');
    }
}
