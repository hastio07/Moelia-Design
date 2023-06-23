<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalCustomPaket extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'cal_custom_pakets';
    protected $fillable = ['created_by', 'nama_paket', 'harga'];
}
