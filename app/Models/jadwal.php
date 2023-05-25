<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'kegiatan', 'lokasi', 'waktu'];
    protected $table = 'jadwal';
    protected $casts = [
        'waktu' => 'datetime',
    ];
}
