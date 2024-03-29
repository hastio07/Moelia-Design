<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Photo;

class FotoController extends Controller
{
    //
    public function index()
    {
        $photos = Photo::latest()->paginate($perPage = 10, $columns = ['*'], $pageName = 'photo');
        return view('user.Foto', compact('photos'));
    }
}
