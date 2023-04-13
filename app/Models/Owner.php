<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['nama_owner', 'foto_owner'];
}
