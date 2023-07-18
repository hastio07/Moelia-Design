<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['pengantar', 'foto_sertifikat'];
}
