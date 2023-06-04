<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, HasFormatRupiah;
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'alamat_domisili', 'kontak', 'besaran_gaji', 'jabatan', 'foto'];
    /**
     * Relasi database table employee ke table category_jabatans (one-to-many (invers))
     */
    public function categoryjabatan()
    {
        return $this->belongsTo(CategoryJabatan::class, 'jabatan', 'id');
    }
}
