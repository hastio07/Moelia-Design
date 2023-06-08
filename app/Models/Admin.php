<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

// use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    // protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'email_verified_status',
        'email',
        'nama_belakang',
        'nama_depan',
        'password',
        'phone_number',
        'remember_token',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $visible = [
        'nama_depan',
        'nama_belakang',
        'email',
        'phone_number',
    ];
    protected $casts = [
        'email_virified_status',
    ];

    /**
     * Relasi database table admins ke table roles (one-to-many (invers))
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
