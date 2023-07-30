<?php

namespace App\Models;

// use App\Traits\HasUUID;

use App\Traits\HasFormatRupiah;
use Hashids\Hashids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManagePesanan extends Model
{
    // use HasFactory, HasUUID;
    use HasFactory, HasFormatRupiah, SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'manage_pesanan';
    protected $append = ['status_konfirmasi'];
    protected $guarded = [];

    public function getIdHashFormatAttribute()
    {
        $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HAS_LENGTH'));
        return $hashids->encode($this->id);
    }

    public function getStatusKonfirmasiAttribute()
    {
        return $this->tanggal_konfirmasi === null ? 'Belum dikonfirmasi' : 'Sudah dikonfirmasi';
    }

    public function setTanggalAkadDanResepsiAttribute($value)
    {
        $this->attributes['tanggal_akad_dan_resepsi'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
    public function getTanggalAkadDanResepsiAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }
    public function getStatusFormatAttribute()
    {
        return $this->status === 'unpaid' ? 'BELUM LUNAS' : 'LUNAS';
    }
    /**
     * Relasi database table manage_pesanan ke table admins (one-to-many)
     */
    public function admin()
    {
        return $this->hasMany(Admin::class);
    }
    /**
     *  Relasi database table manage_pesanan ke table users (one-to-many (invers))
     */
    public function emailPemesan()
    {
        return $this->belongsTo(User::class, 'email_pemesan', 'email');
    }
}
