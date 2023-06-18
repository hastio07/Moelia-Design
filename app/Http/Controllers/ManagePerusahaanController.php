<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Address;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Owner;
use App\Models\Sosmed;
use App\Models\VideoPromosi;
use App\Models\WorkingHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManagePerusahaanController extends Controller
{
    protected $companies;
    protected $contacts;
    protected $sosmeds;
    protected $owners;
    protected $addresses;
    protected $abouts;
    protected $offers;
    protected $workinghours;
    protected $videopromosi;

    public function __construct(Company $companies, Contact $contacts, Sosmed $sosmeds, Owner $owners, Address $addresses, About $abouts, Offer $offers, WorkingHour $workinghours, Videopromosi $videopromosi)
    {
        $this->companies = $companies;
        $this->contacts = $contacts;
        $this->sosmeds = $sosmeds;
        $this->owners = $owners;
        $this->addresses = $addresses;
        $this->abouts = $abouts;
        $this->offers = $offers;
        $this->workinghours = $workinghours;
        $this->videopromosi = $videopromosi;
    }
    public function index()
    {
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $data = [
            'companies' => $this->companies->first(),
            'contacts' => $this->contacts->first(),
            'sosmeds' => $this->sosmeds->first(),
            'owners' => $this->owners->first(),
            'addresses' => $this->addresses->first(),
            'abouts' => $this->abouts->first(),
            'offers' => $this->offers->first(),
            'videopromosi' => $this->videopromosi->first(),
            'workinghours' => $this->workinghours->whereIn('day', $days)->orderBy('day')->get(),
        ];

        return view('admin.manageperusahaan', $data);
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
                        $company = $this->companies->where('logo_perusahaan', $value)->first();
                        if (!$company) {
                            $fail('sesuatu nilai tidak valid');
                        }
                    }
                },
            ],
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
        $this->companies->updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
    }
    public function deletecompany($id)
    {
        $data = $this->companies->findOrFail($id);
        if ($data->logo_perusahaan !== null) {
            $path = $data->logo_perusahaan;
            Storage::delete($path);
        }
        $data->delete();
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
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
                        $owner = $this->owners->where('foto_owner', $value)->first();
                        if (!$owner) {
                            $fail("nilai tidak valid");
                        }
                    }
                },
            ],
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
        $this->owners->updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function deleteowner($id)
    {
        $db = $this->owners->findOrFail($id);
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
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
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
            return dd(back()->withErrors($validator)->withInput()); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }
        $validatedData = $validator->validated();
        // dd($validatedData);
        $id = (int) $request->input('id_alamat');
        // dd($id);
        // update atau create record dengan data yang diberikan
        $this->addresses->updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
    }
    public function deleteaddress($id)
    {
        $data = [
            'alamat_perusahaan' => null,
            'link_gmap' => null,
        ];

        $this->addresses->findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }

    public function updateorcreatecontact(Request $request)
    {
        $rules = [
            'telephone1_name' => 'nullable|string|max:255',
            'telephone1_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'telephone2_name' => 'nullable|string|max:255',
            'telephone2_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'whatsapp1_name' => 'nullable|string|max:255',
            'whatsapp1_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'whatsapp2_name' => 'nullable|string|max:255',
            'whatsapp2_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'whatsapp3_name' => 'nullable|string|max:255',
            'whatsapp3_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'whatsapp4_name' => 'nullable|string|max:255',
            'whatsapp4_number' => 'nullable|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
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
        $this->contacts->updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
    }
    public function deletecontact($id)
    {
        $data = [
            'telephone' => null,
            'whatsapp' => null,
            'email' => null,
        ];
        $this->contacts->findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
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
        $this->sosmeds->updateOrCreate(['id' => $id], $validatedData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
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
        $this->sosmeds->findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }

    public function updateorcreateabout(Request $request)
    {
        $rules = [
            'katasambutan' => 'nullable|string',
            'judul_siapa' => 'nullable|string',
            'fotobersama' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldfotobersama' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value)) {
                    $about = $this->abouts->where('fotobersama', $value)->first();
                    if (!$about) {
                        $fail("nilai tidak valid");
                    }
                }
            }],
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
        $this->abouts->updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function deleteabout($id)
    {
        $db = $this->abouts->findOrFail($id);
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
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }

    public function updateorcreateoffer(Request $request)
    {
        $rules = [
            'penawaran' => 'nullable|string',
            'foto_bersama' => 'nullable|file|image|mimetypes:image/jpeg,image/jpg,image/png|max:2048',
            'oldfoto_bersama' => ['nullable', 'string', function ($attribute, $value, $fail) {
                if (!empty($value)) {
                    $offers = $this->offers->where('foto_bersama', $value)->first();
                    if (!$offers) {
                        $fail("nilai tidak valid");
                    }
                }
            }],
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
        $this->offers->updateOrCreate(['id' => $id], $filterData);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function deleteoffer($id)
    {
        $db = $this->offers->findOrFail($id);
        $data = [
            'penawaran' => null,
            'foto_bersama' => null,
        ];

        if ($db->foto_bersama !== null) {
            $path = $db->foto_bersama;
            Storage::delete($path);
        }

        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
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
                $this->workinghours->updateOrCreate(['id' => $daysId], $filterData);
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
                    $this->workinghours->updateOrCreate(['id' => $daysId], $filterData);
                }
            }
        }

        return redirect()->route('manage-perusahaan.index')->with('success', 'Jam Operasional Berhasil di Perbarui');
    }
}
