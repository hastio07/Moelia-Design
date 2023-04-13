<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['telephone_1', 'telephone_2', 'whatsapp_1', 'whatsapp_2', 'email'];
}
