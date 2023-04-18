<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sosmed extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'u_instagram',
        'l_instagram',
        'u_facebook',
        'l_facebook',
        'u_twitter',
        'l_twitter',
        'u_youtube',
        'l_youtube',
    ];
}
