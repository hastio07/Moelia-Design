<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ManagePesanan;
use App\Notifications\Payment\PembayaranNotification;
use App\Rules\CekEmailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ManagePesananProsesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //Jika request start_date ada value(datanya) maka
            if (!empty($request->start_date)) {
                //Jika tanggal awal(start_date) hingga tanggal akhir(end_date) adalah sama maka
                if ($request->start_date === $request->end_date) {
                    //kita filter tanggalnya sesuai dengan request start_date
                    $list_pesanan = ManagePesanan::where('status', 'unpaid')->orWhere('status', 'expire')->orWhere('status', 'cancel')->orWhere('status', 'pending')->whereDate('created_at', '=', $request->start_date);
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $list_pesanan = ManagePesanan::where('status', 'unpaid')->orWhere('status', 'expire')->orWhere('status', 'cancel')->orWhere('status', 'pending')->whereBetween('created_at', array($request->start_date, $request->end_date));
                }
            }
            $list_pesanan = ManagePesanan::where('status', 'unpaid')->orWhere('status', 'expire')->orWhere('status', 'cancel')->orWhere('status', 'pending');
            return datatables()->of($list_pesanan)
                ->editColumn('nama_pemesan', function ($value) {
                    return '<a href="' . route('manage-pesanan-proses.detail', $value->id) . '">' . $value->nama_pemesan . '</a>';
                })
                ->editColumn('telepon_pemesan', function ($value) {
                    return $value->telepon_pemesan;
                })
                ->editColumn('tanggal_akad_dan_resepsi', function ($value) {
                    return \Carbon\Carbon::parse($value->tanggal_akad_dan_resepsi)->format('l/d-m-Y');
                })
                ->editColumn('alamat_akad_dan_resepsi', function ($value) {
                    return $value->alamat_akad_dan_resepsi;
                })
                ->editColumn('total_biaya_awal', function ($value) {
                    return $value->formatRupiah('total_biaya_awal');
                })
                ->editColumn('total_biaya_seluruh', function ($value) {
                    return $value->formatRupiah('total_biaya_seluruh');
                })
                ->editColumn('uang_muka', function ($value) {
                    return $value->formatRupiah('uang_muka');
                })->addColumn('status_konfirmasi', function ($value) {
                return $value->status_konfirmasi;
            })
                ->editColumn('status', function ($value) {
                    if ($value->status === 'paid') {
                        return '<div class="spinner-grow spinner-grow-sm text-success" role="status"></div> Dibayar';
                    } elseif ($value->status === 'unpaid') {
                        return '<div class="spinner-grow spinner-grow-sm text-success" role="status"></div> Belum Dibayar';
                    } elseif ($value->status === 'cancel') {
                        return '<div class="spinner-grow spinner-grow-sm text-success" role="status"></div> Dibatalkan';
                    } elseif ($value->status === 'expire') {
                        return '<div class="spinner-grow spinner-grow-sm text-success" role="status"></div> Kedaluwarsa';
                    } elseif ($value->status === 'pending') {
                        return '<div class="spinner-grow spinner-grow-sm text-success" role="status"></div> Pending';
                    }
                })
                ->addColumn('aksi', function ($value) {
                    $json = htmlspecialchars(json_encode($value), ENT_QUOTES, 'UTF-8');

                    return '
                        <div class="d-grid d-md-flex justify-content-md-center gap-2">
                            ' . ($value->jenis_pembayaran === 'dp' && ($value->status === 'unpaid' || $value->status === 'expire' || $value->status === 'cancel') ? '
                            <button class="btn btn-danger" data-bs-route="' . route('manage-pesanan-proses.destroy', $value->id) . '" data-bs-target="#DeleteModal" data-bs-toggle="modal" id="btnDeleteModal" type="button"><i class="bi bi-trash"></i></button>
                            ' : '') . ($value->status === 'unpaid' && $value->tanggal_konfirmasi == null && $value->jenis_pembayaran !== 'fp' ? '
                            <button class="btn btn-warning" data-bs-pesanan="' . $json . '" data-bs-route="' . route('manage-pesanan-proses.update', $value->id) . '" data-bs-target="#CUModal" data-bs-toggle="modal" id="btnUpdateModal" type="button"><i class="bi bi-pencil-square"></i></button>
                            ' : '') . ($value->status === 'paid' && $value->tanggal_konfirmasi == null ? '
                            <form action="' . route('manage-pesanan-proses.konfirmasi', $value->id) . '" method="post">
                                 <input type="hidden" name="_method" value="PUT">
                                 <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button class="btn btn-secondary" type="submit"><i class="bi bi-check2"></i></button>
                            </form>
                            ' : '') .
                        '</div>';
                })
                ->rawColumns(['nama_pemesan', 'status', 'aksi'])
                ->make(true);
        }

        return view('admin.ManagePesananProses');
    }

    // Metode untuk memeriksa kevalidan token
    public function isTokenExpired($value)
    {

        // Implementasikan logika untuk memeriksa kevalidan token dengan API Midtrans
        // Pastikan Anda telah menyimpan API Server Key Midtrans
        $serverKey = config('midtrans.sb_server_key');

        // Buat permintaan ke API Midtrans untuk mendapatkan status transaksi berdasarkan token
        $response = Http::withBasicAuth($serverKey, '')->get("https://api.sandbox.midtrans.com/v2/{$value->order_id}/status");

        // Periksa apakah permintaan berhasil
        if ($response->successful()) {
            $data = $response->json();

            if ($data['status_code'] === '401') {
                // Access denied due to unauthorized transaction, please check client key or server key
                return false;
            }

            if ($data['status_code'] === '407') {
                // Expired transaction
                // Dapatkan transaction_status dari respons JSON
                $transactionStatus = $data['transaction_status'];

                // Cek apakah transaction_status adalah 'expire'
                if ($transactionStatus === 'expire') {
                    // Token telah expired
                    return true;
                } else {
                    // Token masih valid
                    return false;
                }
            }

            if ($data['status_code'] === '404') {
                // Transaction doesn't exist
                // Snap Token masih berlaku
                return false;
            }

            if ($data['status_code'] === '502') {
                // Sorry. The bank/payment partner is experiencing some connection issues. Please retry later.
                return false;
            }

        } else {
            // Permintaan gagal, mungkin terjadi kesalahan atau token tidak valid
            return true;
        }
    }

    public function create(Request $request)
    {
        $rules = [
            'nama-pemesan' => 'required|string|max:255',
            'email-pemesan' => ['required', 'string', 'email:dns', new CekEmailUser, 'max:255'],
            'telepon-pemesan' => 'required|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,13}$/',
            'nama-pesanan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'alamat' => 'required|string',
            'biaya-awal' => 'required|numeric|max:9999999999|integer',
            'biaya-additional' => 'required|numeric|max:9999999999|integer',
            'biaya-seluruh' => 'required|numeric|max:9999999999|integer',
            'uang-muka' => 'required|numeric|max:9999999999|integer',
            'materi-kerja' => 'required|string',
            'additional' => 'required|string',
            'bonus' => 'required|string',
        ];
        $massages = [
            'date' => 'kolom :attribute bukan tanggal yang valid.',
            'email' => 'kolom :attribute harus berupa alamat surel yang valid.',
            'integer' => 'kolom :attribute harus berupa angka.',
            'max' => 'kolom :attribute melebihi panjang maksimum yang diizinkan',
            'numeric' => 'kolom :attribute harus dalam format numerik.',
            'regex' => 'format kolom :attribute tidak valid',
            'required' => 'kolom :attribute wajib diisi.',
            'string' => 'kolom :attribute hanya boleh berupa karakter teks.',
        ];

        $customAttributes = [
            'nama-pemesan' => 'Nama Pemesan',
            'email-pemesan' => 'E-mail Pemesan',
            'telepon-pemesan' => 'Telepon Pemesan',
            'nama-pesanan' => 'Nama Pesanan',
            'tanggal' => 'Tanggal',
            'alamat' => 'Alamat',
            'biaya-awal' => 'Total biaya awal',
            'biaya-additional' => 'Total biaya additional',
            'biaya-seluruh' => 'Total biaya seluruh',
            'uang-muka' => 'DP',
            'materi-kerja' => 'Materi Kerja',
            'additional' => 'Additional',
            'bonus' => 'Bonus',
        ];
        //Validasi
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        //Jika gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error_add_pesanan', 'Gagal menambahkan pesanan'); // jika ini di eksekusi maka dibawah tidak akan di eksekusi
        }

        $validatedData = $validator->validated();

        // Ambil data pesanan dengan jenis pembayaran 'dp' atau 'fp' berdasarkan email pemesan
        $dataPengOrder = ManagePesanan::where('email_pemesan', $validatedData['email-pemesan'])
            ->whereIn('jenis_pembayaran', ['dp', 'fp'])
            ->get();

        // Jumlah order dengan jenis pembayaran 'dp' dan 'fp'
        $totalDpOrder = $dataPengOrder->where('jenis_pembayaran', 'dp')->count();
        $totalFpOrder = $dataPengOrder->where('jenis_pembayaran', 'fp')->count();

        // Batasan: Jika sudah ada order dengan jenis pembayaran 'dp' dan 'fp', maka tidak bisa membuat lagi
        if ($totalDpOrder > 0 && $totalFpOrder > 0) {
            return back()->with('error_add_pesanan', 'Tidak dapat membuat order baru atas email ' . $validatedData['email-pemesan'] . ' Karena batas pesanan jenis pembayaran dp dan bayar seluruh sudah dibuat.');
        }

        // // Jika sudah ada order dengan jenis pembayaran 'dp', maka tidak bisa membuat order 'dp' lagi
        // if ($validatedData['jenis-pembayaran'] === 'dp' && $totalDpOrder > 0) {
        //     return back()->with('error_add_pesanan', 'Tidak dapat membuat order baru. Order dengan jenis pembayaran dp sudah ada.');
        // }

        // // Jika sudah ada order dengan jenis pembayaran 'fp', maka tidak bisa membuat order 'fp' lagi
        // if ($validatedData['jenis-pembayaran'] === 'fp' && $totalFpOrder > 0) {
        //     return back()->with('error_add_pesanan', 'Tidak dapat membuat order baru. Order dengan jenis pembayaran fp sudah ada.');
        // }

        //Menampung data request-an setelah validasi

        $data1 = [
            'created_by' => Auth::user()->id,
            'order_id' => Str::uuid(),
            'nama_pemesan' => $validatedData['nama-pemesan'],
            'email_pemesan' => $validatedData['email-pemesan'],
            'telepon_pemesan' => $validatedData['telepon-pemesan'],
            'nama_pesanan' => $validatedData['nama-pesanan'],
            'jenis_pembayaran' => 'dp',
            'tanggal_akad_dan_resepsi' => $validatedData['tanggal'],
            'alamat_akad_dan_resepsi' => $validatedData['alamat'],
            'total_biaya_awal' => $validatedData['biaya-awal'],
            'total_biaya_additional' => $validatedData['biaya-additional'],
            'total_biaya_seluruh' => $validatedData['biaya-seluruh'],
            'uang_muka' => $validatedData['uang-muka'],
            'materi_kerja' => $validatedData['materi-kerja'],
            'additional' => $validatedData['additional'],
            'bonus' => $validatedData['bonus'],
        ];
        //Simpan pesanan
        $dataOrder1 = ManagePesanan::create($data1);

        // Jika transaksi dp sudah ada maka tidak dijalankan
        $data2 = [
            'created_by' => Auth::user()->id,
            'order_id' => Str::uuid(),
            'nama_pemesan' => $validatedData['nama-pemesan'],
            'email_pemesan' => $validatedData['email-pemesan'],
            'telepon_pemesan' => $validatedData['telepon-pemesan'],
            'nama_pesanan' => $validatedData['nama-pesanan'],
            'jenis_pembayaran' => 'fp',
            'tanggal_akad_dan_resepsi' => $validatedData['tanggal'],
            'alamat_akad_dan_resepsi' => $validatedData['alamat'],
            'total_biaya_awal' => $validatedData['biaya-awal'],
            'total_biaya_additional' => $validatedData['biaya-additional'],
            'total_biaya_seluruh' => $dataOrder1->total_biaya_seluruh - $dataOrder1->uang_muka,
            'uang_muka' => 0,
            'materi_kerja' => $validatedData['materi-kerja'],
            'additional' => $validatedData['additional'],
            'bonus' => $validatedData['bonus'],
        ];
        ManagePesanan::create($data2);
        // Untuk mengambil id
        // Untuk mengambil uang muka yang harus di bayar

        //SAMPLE REQUEST START HERE
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.sb_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $fullName = $validatedData['nama-pemesan'];
        // Memecah nama lengkap menjadi array berdasarkan spasi
        $nameParts = explode(' ', $fullName);
        // Mendapatkan nama depan (first name)
        $firstName = $nameParts[0];
        // Menggabungkan sisanya menjadi nama belakang (last name)
        // Jika nama belakang lebih dari satu kata, gabungkan dengan spasi
        $lastName = implode(' ', array_slice($nameParts, 1));

        $params = array(
            'transaction_details' => array(
                'order_id' => $dataOrder1->order_id,
                'gross_amount' => $dataOrder1->uang_muka,
            ),
            'customer_details' => array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $validatedData['email-pemesan'],
                'phone' => $validatedData['telepon-pemesan'],
                'billing_address' => array(
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $validatedData['email-pemesan'],
                    'phone' => $validatedData['telepon-pemesan'],
                    'address' => $validatedData['alamat'],
                    'city' => '',
                    'postal_code' => '',
                    'country_code' => 'IDN',
                ),
            ),
            'page_expiry' => array(
                'duration' => 24,
                'unit' => 'hours',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $dataOrder1->update([
            'snap_token' => $snapToken,
            'snap_token_created_at' => Carbon::now(),
        ]);

        return redirect()->route('manage-pesanan-proses.index')->with('success_add_pesanan', 'Pesanan berhasil disimpan');
    }

    public function update(Request $request, ManagePesanan $id)
    {

    }
    public function destroy(ManagePesanan $order_id)
    {
        if ($order_id->status != 'paid' && $order_id->jenis_pembayaran === 'dp') {
            // Jika status cancel, expire, unpaid dan jenis bayar dp
            // Jika dp dihapus maka fp jg ikut dihapus
            $order_id->delete();
            return redirect()->route('manage-pesanan-proses.index')->with('success_delete_pesanan', 'Pesanan berhasil dihapus');
        }
        // Jika status sudah paid, pending
        return redirect()->route('manage-pesanan-proses.index')->with('error_delete_pesanan', 'Pesanan ini gagal dihapus karena sudah dibayar');
    }

    public function detail(ManagePesanan $data)
    {
        return view('admin.DetailPesanan', compact('data'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.sb_server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            $transaction = $request->transaction_status;
            $ManagePesanan = ManagePesanan::where('order_id', $request->order_id)->first();
            if ($transaction == 'capture' || $transaction == 'settlement') {
                # 1. Update status dan waktu bayar by order_id
                if ($request->settlement_time) {
                    // Jika ada properti settlement_time
                    $waktu_pembayaran = $request->settlement_time;
                } else {
                    // Jika tidak ada properti settlement_time
                    $waktu_pembayaran = Carbon::now();
                }
                $ManagePesanan->update(['status' => 'paid', 'waktu_pembayaran' => $waktu_pembayaran]);
                # 2. Kirim Notifikasi ke seluruh admin
                $admins = Admin::get();
                Notification::send($admins, new PembayaranNotification($ManagePesanan));
                # 3. Update Token Pembayaran Full Payment (fp)
                if ($ManagePesanan->jenis_pembayaran === 'dp') {
                    // Jika yang dibayar jenis dp maka update/buat untuk token fp
                    $this->createTokenFp($ManagePesanan->email_pemesan);
                }
            } else if ($transaction == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                $ManagePesanan->update(['status' => 'pending']);
            } else if ($transaction == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
            } else if ($transaction == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $ManagePesanan->update(['status' => 'expire']);
            } else if ($transaction == 'cancel') {
                // TODO set payment status in merchant's database to 'Cancel'
                $ManagePesanan->update(['status' => 'cancel']);
            }
        } else {
            return response()->json(['status' => 'gagal']);
        }
    }

    private function createTokenFp($email_pemesan)
    {
        $dataOrder = ManagePesanan::where('email_pemesan', $email_pemesan)->where('jenis_pembayaran', 'fp')->first();

        //SAMPLE REQUEST START HERE
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.sb_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $fullName = $dataOrder->nama_pemesan;
        // Memecah nama lengkap menjadi array berdasarkan spasi
        $nameParts = explode(' ', $fullName);
        // Mendapatkan nama depan (first name)
        $firstName = $nameParts[0];
        // Menggabungkan sisanya menjadi nama belakang (last name)
        // Jika nama belakang lebih dari satu kata, gabungkan dengan spasi
        $lastName = implode(' ', array_slice($nameParts, 1));

        $params = array(
            'transaction_details' => array(
                'order_id' => $dataOrder->order_id,
                'gross_amount' => $dataOrder->total_biaya_seluruh,
            ),
            'customer_details' => array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $dataOrder->email_pemesan->email,
                'phone' => $dataOrder->telepon_pemesan,
                'billing_address' => array(
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $dataOrder->email_pemesan->email,
                    'phone' => $dataOrder->telepon_pemesan,
                    'address' => $dataOrder->alamat_akad_dan_resepsi,
                    'city' => '',
                    'postal_code' => '',
                    'country_code' => 'IDN',
                ),
            ),
            'page_expiry' => array(
                'duration' => 24,
                'unit' => 'hours',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $dataOrder->update([
            'snap_token' => $snapToken,
            'snap_token_created_at' => Carbon::now(),
            'status' => 'unpaid',
        ]);

    }

    public function konfirmasi(ManagePesanan $data)
    {
        $data->update(['tanggal_konfirmasi' => now()]);
        return redirect()->route('manage-pesanan-proses.index')->with('success_add_pesanan', 'Pesanan berhasil dikonfirmasi');
    }
}
