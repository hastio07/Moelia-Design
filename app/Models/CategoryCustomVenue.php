<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCustomVenue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'category_custom_venues';
    protected $fillable = ['nama'];

    public function customvenue()
    {
        return $this->hasMany(CalCustomVenue::class, 'kategori_id', 'id');

    }
}
