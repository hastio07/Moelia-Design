<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAdditionalVenue extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'category_additional_venues';
    protected $fillable = ['nama'];

    public function additionalvenue()
    {
        return $this->hasMany(CalAdditionalVenue::class, 'kategori_id', 'id');

    }
}
