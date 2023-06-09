<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Video;
use App\Rules\YouTubeUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ManageGalleryController extends Controller
{
    public function index()
    {
        return redirect()->route('manage-gallery.phototab');
    }
    public function phototab()
    {
        $photos = Photo::latest()->paginate($perPage = 14, $columns = ['*'], $pageName = 'photo');
        $activeTab = 'photo-tab';
        return view('admin.managegallery', compact('photos', 'activeTab'));
    }
    public function createphoto(Request $request)
    {
        $rules = [
            'namagambar' => 'required|string|max:255',
            'gambar.*' => 'file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();
        //Menampung data request setelah validasi
        foreach ($request->file('gambar') as $imagefile) {
            $data = [
                'photo_name' => $validatedData['namagambar'],
            ];
            $imageFileName = date("Y-m-d", time()) . '-' . $imagefile->hashName();
            $oriPath = $imagefile->storeAs('gallery-images', $imageFileName); // -> gallery-images/<nama_files.ext>
            $data['photo_path'] = $oriPath;
            Photo::create($data);
        }
        return redirect()->route('manage-gallery.phototab')->with('success', 'data berhasil disimpan');
    }

    public function destroyphoto($id)
    {
        //
        $get_products = Photo::findOrFail($id);

        if ($get_products) {
            $path = $get_products->photo_path;
            Storage::delete($path);
        }
        Photo::destroy($id);
        return redirect()->route('manage-gallery.phototab')->with('success', 'Data Berhasil DiHapus!');
    }
    public function videotab()
    {

        $activeTab = 'video-tab';
        if (request()->ajax()) {

            $video = Video::query();

            if (request()->has('order') && !empty(request()->input('order'))) {
                $order = request()->input('order')[0];
                $columnIndex = $order['column'];
                $columnName = request()->input('columns')[$columnIndex]['data'];
                $columnDirection = $order['dir'];
                $video->orderBy($columnName, $columnDirection);
            } else {
                $video->orderBy('updated_at', 'desc');
            }

            return DataTables::eloquent($video)->editColumn('video_thumbnail', function ($video) {
                return '<img src="' . $video->video_thumbnail . '" alt="' . $video->video_name . '" height="150" width="250"/>';
            })->editColumn('created_at', function ($date) {
                return $date->created_at->format('d-m-Y H:i:s');
            })->addColumn('aksi', function ($user) {
                return '<div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button class="btn btn-danger" data-bs-route="' . route('manage-gallery.destroyvideo', $user->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                    </div>';
            })->rawColumns(['video_thumbnail', 'aksi'])->make(true);
        }

        return view('admin.managegallery', compact('activeTab'));
    }
    public function createvideo(Request $request)
    {
        $rules = [
            'namavideo' => 'required|string|max:255',
            'linkvideo' => ['required', 'string', 'url', 'max:255', new YouTubeUrl],
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
            'url' => ':attribute harus berupa url valid',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        $data['video_name'] = $validatedData['namavideo'];
        $parsed_url = parse_url($validatedData['linkvideo']);
        if ($parsed_url['host'] === 'youtu.be') {
            $id = ltrim($parsed_url['path'], '/');
        } elseif ($parsed_url['host'] === 'www.youtube.com' && isset($parsed_url['query'])) {
            parse_str($parsed_url['query'], $query_vars);
            if (isset($query_vars['v'])) {
                $id = $query_vars['v'];
            }
        } else {
            $id = basename($parsed_url['path']);
        }

        $data['video_thumbnail'] = 'https://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
        $data['video_path'] = $validatedData['linkvideo'];

        Video::create($data);
        return redirect()->route('manage-gallery.videotab')->with('success', 'data berhasil disimpan');
    }

    public function destroyvideo($id)
    {
        Video::destroy($id);
        return redirect()->route('manage-gallery.videotab')->with('success', 'Data Berhasil DiHapus!');
    }
}
