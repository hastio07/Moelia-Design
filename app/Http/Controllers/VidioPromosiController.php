<?php

namespace App\Http\Controllers;

use App\Models\VideoPromosi;
use App\Rules\YouTubeUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VidioPromosiController extends Controller
{
    public function createvideo(Request $request)
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'link_video' => ['required', 'string', 'url', 'max:255', new YouTubeUrl],
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
            return back()->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        $data['judul'] = $validatedData['judul'];
        $parsed_url = parse_url($validatedData['link_video']);
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

        $data['thumbnail_video'] = 'https://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
        $data['link_video'] = $id;

        $id_video = (int) $request->input('id_video');
        VideoPromosi::updateOrCreate(['id' => $id_video], $data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'data berhasil disimpan');
    }

    public function deletevideopromosi($id)
    {
        $db = VideoPromosi::findOrFail($id);
        $data = [
            'judul' => null,
            'thumbnail_video' => null,
            'link_video' => null,
        ];

        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }
}
