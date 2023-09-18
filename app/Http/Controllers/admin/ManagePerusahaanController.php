<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Address;
use App\Models\Certificate;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Owner;
use App\Models\Sosmed;
use App\Models\VideoPromosi;
use App\Models\VisiMisi;
use App\Models\WorkingHour;
use App\Rules\YouTubeUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManagePerusahaanController extends Controller
{

    public function index()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $data = [
            'owners' => Owner::first(),
            'companies' => Company::first(),
            'videopromosi' => Videopromosi::first(),
            'visi_misis' => VisiMisi::first(),
            'addresses' => Address::first(),
            'contacts' => Contact::first(),
            'sosmeds' => Sosmed::first(),
            'abouts' => About::first(),
            'offers' => Offer::first(),
            'certificates' => Certificate::first(),
            'workinghours' => WorkingHour::whereIn('day', $days)->orderBy('day')->get(),
        ];

        return view('admin.ManagePerusahaan', $data);
    }
    public function updateorcreateowner(Request $request)
    {

        $rules = [
            'nama_owner' => 'nullable|string|max:255',
            'kata_sambutan' => 'nullable|string',
            'foto_owner' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldfoto_owner' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $owner = Owner::where('foto_owner', $value)->first();
                        if (!$owner) {
                            $fail("nilai tidak valid");
                        }
                    }
                },
            ],
        ];
        $massages = [
            'nama_owner.max' => ':attribute harus diisi maksimal :max karakter.',
            'foto_owner.max' => 'ukuran gambar maksimal 2MB',
            'string' => ':attribute harus berupa teks.',
            'required' => ':attribute wajib diisi.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        // dd($validatedData);

        $filterData['nama_owner'] = $validatedData['nama_owner'];
        $filterData['kata_sambutan'] = $validatedData['kata_sambutan'];

        if ($request->hasFile('foto_owner')) {
            if ($validatedData['oldfoto_owner']) {
                $path = $validatedData['oldfoto_owner'];
                Storage::delete($path);
            }

            $imagefile = $validatedData['foto_owner'];
            $imageFileName = date("Y-m-d", time()) . '-' . $imagefile->getClientOriginalName();
            $oriPath = $imagefile->storeAs('owner-images', $imageFileName); // -> owner-images/<nama_files.ext>
            $filterData['foto_owner'] = $oriPath;
        }
        $id = (int) $request->input('id_owner');
        // dd($id);
        // update atau create record dengan data yang diberikan
        Owner::updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success_owner', 'Data berhasil disimpan');
    }

    public function deleteowner($id)
    {
        $db = Owner::findOrFail($id);
        if ($db->foto_owner !== null) {
            $path = $db->foto_owner;
            Storage::delete($path);
        }
        $data = [
            'nama_owner' => null,
            'kata_sambutan' => null,
            'foto_owner' => null,
        ];
        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_owner', 'Data berhasil dihapus!');
    }
    public function updateorcreatecompany(Request $request)
    {

        $rules = [
            'nama_perusahaan' => 'nullable|string|max:255',
            'logo_perusahaan' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldlogo_perusahaan' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $company = Company::where('logo_perusahaan', $value)->first();
                        if (!$company) {
                            $fail('sesuatu nilai tidak valid');
                        }
                    }
                },
            ],
        ];
        $massages = [
            'nama_perusahaan.max' => ':attribute harus diisi maksimal :max karakter.',
            'logo_perusahaan.max' => 'ukuran gambar maksimal 2MB',
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
        // dd($validatedData);
        if ($request->has('nama_perusahaan')) {
            $filterData['nama_perusahaan'] = $validatedData['nama_perusahaan'];
        }

        if ($request->hasFile('logo_perusahaan')) {
            if ($validatedData['oldlogo_perusahaan']) {
                $path = $validatedData['oldlogo_perusahaan'];
                Storage::delete($path);
            }

            $imagefile = $validatedData['logo_perusahaan'];
            $imageFileName = date("Y-m-d", time()) . '-' . $imagefile->getClientOriginalName();
            $oriPath = $imagefile->storeAs('logo-images', $imageFileName); // -> logo-images/<nama_files.ext>
            $filterData['logo_perusahaan'] = $oriPath;
        }
        $id = (int) $request->input('id_perusahaan');
        // dd($id);
        // update atau create record dengan data yang diberikan
        Company::updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success_company', 'Data berhasil disimpan');
    }
    public function deletecompany($id)
    {
        $data = Company::findOrFail($id);
        if ($data->logo_perusahaan !== null) {
            $path = $data->logo_perusahaan;
            Storage::delete($path);
        }
        $data->delete();
        return redirect()->route('manage-perusahaan.index')->with('success_company', 'Data berhasil dihapus!');
    }
    public function updateorcreatevideopromosi(Request $request)
    {
        $rules = [
            'judul-video-promosi' => 'required|string|max:255',
            'link-video-promosi' => ['required', 'string', 'url', 'max:255', new YouTubeUrl],
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

        $data['judul'] = $validatedData['judul-video-promosi'];
        $parsed_url = parse_url($validatedData['link-video-promosi']);
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

        $id = (int) $request->input('id_video');
        VideoPromosi::updateOrCreate(['id' => $id], $data);
        return redirect()->route('manage-perusahaan.index')->with('success_promosi', 'Data berhasil disimpan');
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
        return redirect()->route('manage-perusahaan.index')->with('success_promosi', 'Data berhasil dihapus!');
    }

    public function updateorcreatevisimisi(Request $request)
    {
        $rules = [
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ];
        $massages = [
            'string' => ':attribute harus berupa teks.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        // dd($validatedData);
        $id = (int) $request->input('id_visimisi');
        // dd($id);
        // update atau create record dengan data yang diberikan
        VisiMisi::updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success_visimisis', 'Data berhasil disimpan');
    }
    public function deletevisimisi($id)
    {
        $data = [
            'visi' => null,
            'misi' => null,
        ];

        VisiMisi::findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_visimisis', 'Data berhasil dihapus!');
    }

    public function updateorcreateaddress(Request $request)
    {
        $rules = [
            'alamat_perusahaan' => 'nullable|string',
            'link_gmap' => 'nullable|string',
        ];
        $massages = [
            'string' => ':attribute harus berupa teks.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        // dd($validatedData);
        $id = (int) $request->input('id_alamat');
        // dd($id);
        // update atau create record dengan data yang diberikan
        Address::updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success_address', 'Data berhasil disimpan');
    }
    public function deleteaddress($id)
    {
        $data = [
            'alamat_perusahaan' => null,
            'link_gmap' => null,
        ];

        Address::findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_address', 'Data berhasil dihapus!');
    }

    public function updateorcreatecontact(Request $request)
    {
        $rules = [
            'telephone1_name' => 'nullable|string|max:255',
            'telephone1_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'telephone2_name' => 'nullable|string|max:255',
            'telephone2_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'whatsapp1_name' => 'nullable|string|max:255',
            'whatsapp1_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'whatsapp2_name' => 'nullable|string|max:255',
            'whatsapp2_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'whatsapp3_name' => 'nullable|string|max:255',
            'whatsapp3_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'whatsapp4_name' => 'nullable|string|max:255',
            'whatsapp4_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'email' => 'nullable|email|max:255',
        ];
        $messages = [
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'regex' => 'format :attribute tidak valid',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'numeric' => ':attribute harus dalam format numerik.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
        ];
        // foreach ($rules as $field => $rule) {
        //     if (!Str::contains($rule, 'email')) {
        //         $messages["{$field}.max"] = ":attribute harus diisi maksimal :max karakter.";
        //     }
        // }
        //Validasi
        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->setAttributeNames([
            'telephone1_name' => 'Nama Telepon 1',
            'telephone1_number' => 'Nomor Telepon 1',
            'telephone2_name' => 'Nama Telepon 2',
            'telephone2_number' => 'Nomor Telepon 2',
            'whatsapp1_name' => 'Nama WhatsApp 1',
            'whatsapp1_number' => 'Nomor WhatsApp 1',
            'whatsapp2_name' => 'Nama WhatsApp 2',
            'whatsapp2_number' => 'Nomor WhatsApp 2',
            'whatsapp3_name' => 'Nama WhatsApp 3',
            'whatsapp3_number' => 'Nomor WhatsApp 3',
            'whatsapp4_name' => 'Nama WhatsApp 4',
            'whatsapp4_number' => 'Nomor WhatsApp 4',
            'email' => 'E-mail',
        ]);

        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();

        $id = (int) $request->input('id_contact');
        // dd($id);
        // update atau create record dengan data yang diberikan
        Contact::updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success_contact', 'Data berhasil disimpan');
    }
    public function deletecontact($id)
    {
        $data = [
            'telephone1_name' => null,
            'telephone1_number' => null,
            'telephone2_name' => null,
            'telephone2_number' => null,
            'whatsapp1_name' => null,
            'whatsapp1_number' => null,
            'whatsapp2_name' => null,
            'whatsapp2_number' => null,
            'whatsapp3_name' => null,
            'whatsapp3_number' => null,
            'whatsapp4_name' => null,
            'whatsapp4_number' => null,
            'email' => null,
        ];
        Contact::findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_contact', 'Data berhasil dihapus!');
    }

    public function updateorcreatesosmed(Request $request)
    {
        $rules = [
            'u_instagram' => 'nullable|string|max:255',
            'l_instagram' => 'nullable|string|max:255',
            'u_facebook' => 'nullable|string|max:255',
            'l_facebook' => 'nullable|string|max:255',
            'u_twitter' => 'nullable|string|max:255',
            'l_twitter' => 'nullable|string|max:255',
            'u_tiktok' => 'nullable|string|max:255',
            'l_tiktok' => 'nullable|string|max:255',
            'u_youtube' => 'nullable|string|max:255',
            'l_youtube' => 'nullable|string|max:255',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        $id = (int) $request->input('id_sosmed');
        // dd($id);
        // update atau create record dengan data yang diberikan
        Sosmed::updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success_sosmed', 'Data berhasil disimpan');
    }

    public function deletesosmed($id)
    {
        $data = [
            'u_instagram' => null,
            'l_instagram' => null,
            'u_facebook' => null,
            'l_facebook' => null,
            'u_twitter' => null,
            'l_twitter' => null,
            'u_tiktok' => null,
            'l_tiktok' => null,
            'u_youtube' => null,
            'l_youtube' => null,
        ];
        Sosmed::findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_sosmed', 'Data berhasil dihapus!');
    }

    public function updateorcreateabout(Request $request)
    {
        $rules = [
            'katasambutan' => 'nullable|string',
            'judul_siapa' => 'nullable|string',
            'fotobersama' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldfotobersama' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value)) {
                    $about = About::where('fotobersama', $value)->first();
                    if (!$about) {
                        $fail("nilai tidak valid");
                    }
                }
            }],
        ];
        $massages = [
            'fotobersama.max' => 'ukuran gambar maksimal 2MB',
            'string' => ':attribute harus berupa teks.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        $filterData['katasambutan'] = $validatedData['katasambutan'];
        $filterData['judul'] = $validatedData['judul_siapa'];
        if ($request->hasFile('fotobersama')) {
            if ($validatedData['oldfotobersama']) {
                $path = $validatedData['oldfotobersama'];
                Storage::delete($path);
            }

            $imagefile = $validatedData['fotobersama'];
            $imageFileName = date("Y-m-d", time()) . '-' . $imagefile->getClientOriginalName();
            $oriPath = $imagefile->storeAs('fotobersama', $imageFileName); // -> owner-images/<nama_files.ext>
            $filterData['fotobersama'] = $oriPath;
        }

        $id = (int) $request->input('id_about');
        // dd($id);
        // update atau create record dengan data yang diberikan
        About::updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success_about', 'Data berhasil disimpan');
    }

    public function deleteabout($id)
    {
        $db = About::findOrFail($id);
        $data = [
            'katasambutan' => null,
            'fotobersama' => null,
            'judul' => null,
        ];

        if ($db->fotobersama !== null) {
            $path = $db->fotobersama;
            Storage::delete($path);
        }

        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_about', 'Data berhasil dihapus!');
    }

    public function updateorcreateoffer(Request $request)
    {
        $rules = [
            'penawaran' => 'nullable|string',
            'foto_bersama' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldfoto_bersama' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value)) {
                    $offers = Offer::where('foto_bersama', $value)->first();
                    if (!$offers) {
                        $fail("nilai tidak valid");
                    }
                }
            }],
        ];
        $massages = [
            'foto_bersama.max' => 'ukuran gambar maksimal 2MB',
            'string' => ':attribute harus berupa teks.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();

        $filterData['penawaran'] = $validatedData['penawaran'];

        if ($request->hasFile('foto_bersama')) {
            if ($validatedData['oldfoto_bersama']) {
                $path = $validatedData['oldfoto_bersama'];
                Storage::delete($path);
            }

            $imagefile = $validatedData['foto_bersama'];
            $imageFileName = 'offers' . '-' . date("Y-m-d", time()) . '-' . $imagefile->getClientOriginalName();
            $oriPath = $imagefile->storeAs('fotobersama', $imageFileName); // -> fotobersama/<nama_files.ext>
            // dd($oriPath);
            $filterData['foto_bersama'] = $oriPath;
        }

        $id = (int) $request->input('id_offer');
        // dd($filterData);
        // update atau create record dengan data yang diberikan
        Offer::updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success_offer', 'Data berhasil disimpan');
    }

    public function deleteoffer($id)
    {
        $db = Offer::findOrFail($id);
        $data = [
            'penawaran' => null,
            'foto_bersama' => null,
        ];

        if ($db->foto_bersama !== null) {
            $path = $db->foto_bersama;
            Storage::delete($path);
        }

        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_offer', 'Data berhasil dihapus!');
    }

    public function updateorcreatecertificate(Request $request)
    {
        $rules = [
            'pengantar' => 'nullable|string',
            'foto_sertifikat' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldfoto_sertifikat' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value)) {
                    $certificates = Certificate::where('foto_sertifikat', $value)->first();
                    if (!$certificates) {
                        $fail("nilai tidak valid");
                    }
                }
            }],
        ];
        $massages = [
            'foto_sertifikat.max' => 'ukuran gambar maksimal 2MB',
            'string' => ':attribute harus berupa teks.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();

        $filterData['pengantar'] = $validatedData['pengantar'];

        if ($request->hasFile('foto_sertifikat')) {
            if ($validatedData['oldfoto_sertifikat']) {
                $path = $validatedData['oldfoto_sertifikat'];
                Storage::delete($path);
            }

            $imagefile = $validatedData['foto_sertifikat'];
            $imageFileName = 'certificates' . '-' . date("Y-m-d", time()) . '-' . $imagefile->getClientOriginalName();
            $oriPath = $imagefile->storeAs('fotosertifikat', $imageFileName); // -> fotosertifikat/<nama_files.ext>
            // dd($oriPath);
            $filterData['foto_sertifikat'] = $oriPath;
        }

        $id = (int) $request->input('id_certificate');
        // dd($filterData);
        // update atau create record dengan data yang diberikan
        Certificate::updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success_certificate', 'Data berhasil disimpan');
    }

    public function deletecertificate($id)
    {
        $db = Certificate::findOrFail($id);
        $data = [
            'pengantar' => null,
            'foto_sertifikat' => null,
        ];

        if ($db->foto_sertifikat !== null) {
            $path = $db->foto_sertifikat;
            Storage::delete($path);
        }

        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success_certificate', 'Data berhasil dihapus!');
    }

    public function updateorcreatejo(Request $request)
    {
        $rules = [
            'day.*' => 'required',
            'from.*' => 'nullable',
            'to.*' => 'nullable',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'required' => ':attribute wajib diisi.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
        //Jika gagal
        if ($validator->fails()) {
            return dd(redirect()->back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        // dd($validatedData);
        // Iterasi melalui data yang dikirimkan
        $daysIdx = [1, 2, 3, 4, 5, 6, 7];

        foreach ($daysIdx as $daysId) {
            if (!isset($validatedData['day'][$daysId])) {
                $filterData = [
                    'status' => false,
                ];
                WorkingHour::updateOrCreate(['id' => $daysId], $filterData);
            } else {
                foreach ($validatedData['day'][$daysId] as $index => $isChecked) {
                    // Konversi nilai 'true' menjadi true
                    $status = $isChecked === 'true' ? true : false;
                    // Mendapatkan data waktu berdasarkan ID hari dan indeks
                    $filterData = [
                        'status' => $status,
                        'time_from' => isset($validatedData['from'][$daysId][$index]) ? $validatedData['from'][$daysId][$index] : null,
                        'time_to' => isset($validatedData['to'][$daysId][$index]) ? $validatedData['to'][$daysId][$index] : null,
                    ];
                    WorkingHour::updateOrCreate(['id' => $daysId], $filterData);
                }
            }
        }

        return redirect()->route('manage-perusahaan.index')->with('success_jo', 'Jam operasional berhasil diperbarui');
    }

}
