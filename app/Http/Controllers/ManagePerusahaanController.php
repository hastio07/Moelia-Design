<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Owner;
use App\Models\Sosmed;
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

    public function __construct(Company $companies, Contact $contacts, Sosmed $sosmeds, Owner $owners, Address $addresses)
    {
        $this->companies = $companies;
        $this->contacts = $contacts;
        $this->sosmeds = $sosmeds;
        $this->owners = $owners;
        $this->addresses = $addresses;

    }
    public function index()
    {
        $data = [
            'companies' => $this->companies->first(),
            'contacts' => $this->contacts->first(),
            'sosmeds' => $this->sosmeds->first(),
            'owners' => $this->owners->first(),
            'addresses' => $this->addresses->first(),
        ];
        return view('dashboard.admin.manageperusahaan', $data);
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
        if ($request->has('nama_owner')) {
            $filterData['nama_owner'] = $validatedData['nama_owner'];
        }
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
        $data = ['nama_owner' => null, 'foto_owner' => null];
        $db->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }

    public function updateorcreateaddress(Request $request)
    {
        $rules = [
            'alamat_perusahaan' => 'nullable|string',
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
        ];

        $this->addresses->findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }

    public function updateorcreatsosmed(Request $request)
    {
        $rules = [
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
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
            'instagram' => null,
            'facebook' => null,
            'twitter' => null,
            'youtube' => null,
        ];
        $this->sosmeds->findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }

    public function updateorcreatcontact(Request $request)
    {
        $rules = [
            'telephone_1' => 'nullable|string|max:255',
            'telephone_2' => 'nullable|string|max:255',
            'whatsapp_1' => 'nullable|string|max:255',
            'whatsapp_2' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ];
        $massages = [
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'string' => ':attribute harus berupa teks.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);
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
            'telephone_1' => null,
            'telephone_2' => null,
            'whatsapp_1' => null,
            'whatsapp_2' => null,
            'email' => null,
        ];
        $this->contacts->findOrFail($id)->update($data);
        return redirect()->route('manage-perusahaan.index')->with('success', 'Data Berhasil DiHapus!');
    }
}
