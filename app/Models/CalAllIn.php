<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalAllIn extends Model
{
    use HasFactory, HasFormatRupiah;

    protected $primaryKey = 'id';
    protected $table = 'cal_all_ins';
    protected $fillable = ['created_by', 'nama_paket', 'harga'];
}
