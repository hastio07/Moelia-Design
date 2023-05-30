<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'telephone1_name',
        'telephone1_number',
        'telephone2_name',
        'telephone2_number',
        'whatsapp1_name',
        'whatsapp1_number',
        'whatsapp2_name',
        'whatsapp2_number',
        'whatsapp3_name',
        'whatsapp3_number',
        'whatsapp4_name',
        'whatsapp4_number',
        'email'];

}
