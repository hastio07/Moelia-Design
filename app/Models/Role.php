<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $tabel = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['level'];
    protected $hidden = ['id'];

    /**
     * Relasi database table roles ke table admins (one-to-many)
     */
    public function admin()
    {
        return $this->hasMany(Admin::class);
    }
}
