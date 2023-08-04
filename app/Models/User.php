<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\ResetPassword\SendResetPasswordLink;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'nama_depan',
        'nama_belakang',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SendResetPasswordLink($token));
    }
    /**
     * Relasi database table users ke table roles (one-to-many (invers))
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi database table users ke table manage_pesanan (one-to-many)
     */
    public function pesanan()
    {
        return $this->hasMany(ManagePesanan::class, 'email_pemesan', 'email');
    }
}
