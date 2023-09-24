<?php

namespace App\Models;

// use App\Traits\HasUUID;

use App\Traits\HasFormatRupiah;
use Carbon\Carbon;
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
    protected $with = ['createdBy', 'emailPemesan'];
    protected $guarded = [];

    public function getIdHashFormatAttribute()
    {
        $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HAS_LENGTH'));
        return $hashids->encode($this->id);
    }

    public function getStatusKonfirmasiAttribute()
    {
        return $this->tanggal_konfirmasi === null ? 'Belum Dikonfirmasi' : 'Dikonfirmasi';
    }

    public function setTanggalAkadDanResepsiAttribute($value)
    {
        $this->attributes['tanggal_akad_dan_resepsi'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
    }
    public function getTanggalAkadDanResepsiAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }
    public function getStatusFormatAttribute()
    {
        return $this->status === 'unpaid' ? 'BELUM LUNAS' : 'LUNAS';
    }
    public function getSelisihWaktuSnapTokenFormatAttribute()
    {
        // Waktu saat ini
        $waktuSaatIni = Carbon::now();
        // Waktu yang diberikan
        $waktuDibuat = Carbon::parse($this->snap_token_created_at);
        // Hitung selisih waktu dalam jam
        $selisihJam = $waktuDibuat->diffInHours($waktuSaatIni);
        return $selisihJam;
    }
    /**
     * Relasi database table manage_pesanan ke table admins (one-to-many)
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }
    /**
     *  Relasi database table manage_pesanan ke table users (one-to-many (invers))
     */
    public function emailPemesan()
    {
        return $this->belongsTo(User::class, 'email_pemesan', 'email');
    }
}
