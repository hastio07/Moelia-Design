<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['nama_owner', 'kata_sambutan', 'foto_owner'];
}
