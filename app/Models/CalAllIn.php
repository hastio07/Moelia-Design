<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalAllIn extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'cal_all_ins';
    protected $fillable = ['created_by', 'nama_paket', 'harga'];
}
