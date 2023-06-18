<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoPromosi extends Model
{
    use HasFactory;

    protected $table = 'video_promosis';
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'thumbnail_video', 'link_video'];
}
