<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CalAdditionalVenue;
use App\Models\CalAllIn;
use App\Models\CalCustomPaket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManageWeddingCalulatorController extends Controller
{
    public function index()
    {
        return view('admin.ManageWeddingCalculator');
    }

    public function cAllIn(Request $request)
    {

        $rules = [
            'nama-paket-allin' => 'required|string|max:255',
            'harga-paket-allin' => 'required|numeric|max:9999999999|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-allin.numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_paket_allin', 'Gagal menambahkan paket All-In'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-allin'],
            'harga_sewa' => (int) $validatedData['harga-paket-allin'],
        ];

        //Simpan paket allin
        CalAllIn::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_paket_allin', 'Paket All-In berhasil disimpan');
    }

    public function cCustomPaket(Request $request)
    {

        $rules = [
            'nama-paket-custompaket' => 'required|string|max:255',
            'harga-paket-custompaket' => 'required|numeric|max:9999999999|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-custompaket.numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_paket_custompaket', 'Gagal menambahkan Custom Paket'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-custompaket'],
            'harga_sewa' => (int) $validatedData['harga-paket-custompaket'],
        ];

        //Simpan paket custom paket
        CalCustomPaket::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_paket_custompaket', 'Custom paket berhasil disimpan');
    }

    public function cAdditionalVenue(Request $request)
    {

        $rules = [
            'nama-paket-additionalvenue' => 'required|string|max:255',
            'harga-paket-additionalvenue' => 'required|numeric|max:9999999999|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-additionalvenue.numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_paket_additionalvenue', 'Gagal menambahkan paket Additional Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-additionalvenue'],
            'harga_sewa' => (int) $validatedData['harga-paket-additionalvenue'],
        ];

        //Simpan paket custom paket
        CalAdditionalVenue::create($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_add_paket_additionalvenue', 'Paket Additional Venue berhasil disimpan');
    }

    ////////////////////////>>>>>>>>>>>>>>>>> UPDATE <<<<<<<<<<<<<<<<<////////////////////////
    public function uAllIn(Request $request, $id)
    {

        $rules = [
            'nama-paket-allin' => 'required|string|max:255',
            'harga-paket-allin' => 'required|numeric|max:9999999999|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-allin.numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_paket_allin', 'Gagal mengubah paket All-in'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-allin'],
            'harga_sewa' => (int) $validatedData['harga-paket-allin'],
        ];

        //Simpan paket allin
        $CalAllIn = CalAllIn::findOrFail($id);

        $CalAllIn->update($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_edit_paket_allin', 'Paket All-In berhasil diubah');
    }

    public function uCustomPaket(Request $request, $id)
    {
        $rules = [
            'nama-paket-custompaket' => 'required|string|max:255',
            'harga-paket-custompaket' => 'required|numeric|max:9999999999|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-custompaket.numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_paket_custompaket', 'Gagal mengubah Custom Paket'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-custompaket'],
            'harga_sewa' => (int) $validatedData['harga-paket-custompaket'],
        ];

        //Simpan paket custom paket
        $CalCustomPaket = CalCustomPaket::findOrFail($id);

        $CalCustomPaket->update($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_edit_paket_custompaket', 'Custom Paket berhasil diubah');

    }
    public function uAdditionalVenue(Request $request, $id)
    {
        $rules = [
            'nama-paket-additionalvenue' => 'required|string|max:255',
            'harga-paket-additionalvenue' => 'required|numeric|max:9999999999|integer',
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'max' => ':attribute melebihi panjang maksimum yang diizinkan',
            'string' => ':attribute hanya boleh berupa karakter teks.',
            'harga-paket-additionalvenue.numeric' => ':attribute harus dalam format numerik.',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_edit_paket_additionalvenue', 'Gagal mengubah paket Additional Venue'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        //Menampung data request setelah validasi
        $data = [
            'created_by' => Auth::user()->id,
            'nama_paket' => $validatedData['nama-paket-additionalvenue'],
            'harga_sewa' => (int) $validatedData['harga-paket-additionalvenue'],
        ];

        //Simpan paket custom paket
        $CalAdditionalVenue = CalAdditionalVenue::findOrFail($id);

        $CalAdditionalVenue->update($data);

        return redirect()->route('manage-wedding-calculator.index')->with('success_edit_paket_additionalvenue', 'Paket Additional Venue berhasil diubah');
    }

    ////////////////////////>>>>>>>>>>>>>>>>> DESTROY <<<<<<<<<<<<<<<<<////////////////////////

    public function dAllIn($id)
    {
        $getPaketAllin = CalAllIn::findOrFail($id);
        if ($getPaketAllin) {
            $getPaketAllin->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_allin', 'Paket All In berhasil dihapus');
        }

        // return back()->route('manage-wedding-calculator.index')->with('failed_delete_allin', 'Gagal dihapus paket All-In tidak ditemukan');
    }
    public function dCustomPaket($id)
    {
        $getCustomPaket = CalCustomPaket::findOrFail($id);
        if ($getCustomPaket) {
            $getCustomPaket->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_custompaket', 'Custom Paket berhasil dihapus');
        }
        // return back()->route('manage-wedding-calculator.index')->with('failed_delete_custompaket', 'Gagal dihapus Custom Paket tidak ditemukan');
    }
    public function dAdditionalVenue($id)
    {
        $getPaketAdditionalVenue = CalAdditionalVenue::findOrFail($id);
        if ($getPaketAdditionalVenue) {
            $getPaketAdditionalVenue->delete();
            return redirect()->route('manage-wedding-calculator.index')->with('success_delete_additionalvenue', 'Paket Additional Venue berhasil dihapus');
        }
        // return back()->route('manage-wedding-calculator.index')->with('failed_delete_additionalvenue', 'Gagal dihapus paket Additional Venue tidak ditemukan');
    }
}
