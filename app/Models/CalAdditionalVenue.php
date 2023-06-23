<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalAdditionalVenue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'cal_additional_venues';
    protected $fillable = ['created_by', 'nama_paket', 'harga'];
}
