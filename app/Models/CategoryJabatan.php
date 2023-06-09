<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryJabatan extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'category_jabatans';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_jabatan', 'slug_jabatan'];

    /**
     * Menggantikan karakter-karakter khusus atau spasi dengan karakter yang lebih ramah untuk dibaca, seperti huruf kecil dan tanda hubung.
     */
    public function sluggable(): array
    {
        return [
            'slug_jabatan' => [
                'source' => 'nama_jabatan',
            ],
        ];
    }

    /**
     * Relasi database table category_jabatans ke table employees (one-to-many)
     */
    public function employee()
    {
        return $this->hasMany(Employee::class, 'jabatan', 'id');
    }
}
