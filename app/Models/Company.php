<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['nama_perusahaan', 'logo_perusahaan'];
}
