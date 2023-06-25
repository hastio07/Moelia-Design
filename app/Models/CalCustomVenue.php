<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalCustomVenue extends Model
{
    use HasFactory, HasFormatRupiah;

    protected $primaryKey = 'id';
    protected $table = 'cal_custom_venues';
    protected $fillable = ['created_by', 'kategori_id', 'nama_paket', 'harga'];
    protected $visible = [
        'kategori_id',
        'nama_paket',
        'harga',
    ];
    public function categorycustomvenue()
    {
        return $this->belongsTo(CategoryCustomVenue::class, 'kategori_id', 'id');
    }

}
