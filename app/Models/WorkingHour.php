<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'day',
        'status',
        'time_from',
        'time_to',
    ];
    protected $casts = [
        'time_from' => 'datetime',
        'time_to' => 'datetime',
    ];
    
    public function getTimeFromFormatAttribute()
    {
        if (isset($this->time_from)) {
            // Memotong string waktu dan mengambil jam:menit saja
            return $this->time_from->format('H:i');
        } else {
            return null;
        }
    }

    public function getTimeToFormatAttribute()
    {
        if (isset($this->time_to)) {
            // Memotong string waktu dan mengambil jam:menit saja
            return $this->time_to->format('H:i');
        } else {
            return null;
        }
    }
}
