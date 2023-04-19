<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate($perPage = 8, $columns = ['*']);
        return view('dashboard.user.vidio', compact('videos'));
    }
}
