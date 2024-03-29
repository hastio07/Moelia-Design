<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ManagePesanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PembayaranUserController extends Controller
{
    public function index()
    {
        $bayar_dp = ManagePesanan::where('email_pemesan', auth()->user()->email)
            ->where('jenis_pembayaran', 'dp')
            ->first();
        $contact = Contact::first();
        $bayar_fp = ManagePesanan::where('email_pemesan', auth()->user()->email)
            ->where('jenis_pembayaran', 'fp')
            ->first();

        return view('user.Pembayaran', compact('bayar_dp', 'contact', 'bayar_fp'));
    }

    // Metode untuk merefresh token dengan permintaan ke server Midtrans
    public function refreshMidtransToken(ManagePesanan $data)
    {
        // Implementasikan permintaan ke server Midtrans untuk mendapatkan token baru
        // Gunakan API Midtrans untuk melakukan permintaan token baru
        //SAMPLE REQUEST START HERE
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.sb_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $fullName = $data->nama_pemesan;
        // Memecah nama lengkap menjadi array berdasarkan spasi
        $nameParts = explode(' ', $fullName);
        // Mendapatkan nama depan (first name)
        $firstName = $nameParts[0];
        // Menggabungkan sisanya menjadi nama belakang (last name)
        // Jika nama belakang lebih dari satu kata, gabungkan dengan spasi
        $lastName = implode(' ', array_slice($nameParts, 1));

        if ($data->jenis_pembayaran === 'dp') {
            $gross_amount = $data->uang_muka;
        } elseif ($data->jenis_pembayaran === 'fp') {
            $gross_amount = $data->total_biaya_seluruh;
        }

        $new_order_id = Str::uuid();

        $params = array(
            'transaction_details' => array(
                'order_id' => $new_order_id,
                'gross_amount' => $gross_amount,
            ),
            'customer_details' => array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $data->email_pemesan,
                'phone' => $data->telepon_pemesan,
                'billing_address' => array(
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $data->email_pemesan,
                    'phone' => $data->telepon_pemesan,
                    'address' => $data->alamat_akad_dan_resepsi,
                    // 'city' => '',
                    // 'postal_code' => '',
                    'country_code' => 'IDN',
                ),
            ),
        );

        $newSnapToken = \Midtrans\Snap::getSnapToken($params);
        $data->update([
            'order_id' => $new_order_id,
            'snap_token' => $newSnapToken,
            'snap_token_created_at' => Carbon::now(),
            'status' => 'unpaid']);

        return redirect()->route('user-pembayaran.index');
    }

    public function cancel($id_order)
    {
        dd($id_order);
        // Note: transaksi bisa di-cancel jika transaksi pending dan belum masuk ke fase expired atau belum selesai masa berlakunya
        $serverKey = config('midtrans.sb_server_key');
        $response = Http::withBasicAuth($serverKey, '')->post("https: //api.sandbox.midtrans.com/v2/$id_order/cancel");
        if ($response->successful()) {
            $data = $response->json();

            if ($data['status_code'] === '412') {
                return redirect()->route('user-pembayaran.index')->with('message', 'Merchant cannot modify the status of the transaction.');
            }

            if ($data['status_code'] === '200') {

                $transactionStatus = $data['transaction_status'];

                if ($transactionStatus === 'cancel') {
                    return redirect()->route('user-pembayaran.index')->with('message', 'Success, transaction is canceled.');
                }
            }

            if ($data['status_code'] === '401') {
                return redirect()->route('user-pembayaran.index')->with('message', 'Transaction cannot be authorized with the current client/server key.');
            }
        }
        return redirect()->route('user-pembayaran.index');
    }
}
