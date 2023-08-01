<?php

use App\Http\Controllers\admin\DashboardAdminsController;
use App\Http\Controllers\admin\ManageAdminController;
use App\Http\Controllers\admin\ManageGalleryController;
use App\Http\Controllers\admin\ManageGudangController;
use App\Http\Controllers\admin\ManageJadwalController;
use App\Http\Controllers\admin\ManageLayananController;
use App\Http\Controllers\admin\ManagePegawaiController;
use App\Http\Controllers\admin\ManagePerusahaanController;
use App\Http\Controllers\admin\ManagePesananProsesController;
use App\Http\Controllers\admin\ManagePesananSelesaiController;
use App\Http\Controllers\admin\ManageProdukController;
use App\Http\Controllers\admin\ManageWeddingCalculatorController;
use App\Http\Controllers\admin\ProfileAdminController;
use App\Http\Controllers\user\AboutController;
use App\Http\Controllers\user\CalculatorController;
use App\Http\Controllers\user\FotoController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\PembayaranUserController;
use App\Http\Controllers\user\ProdukController;
use App\Http\Controllers\user\ProfileUserController;
use App\Http\Controllers\user\VideoController;
use App\Models\Admin;
use App\Notifications\ResetPassword\SendResetPasswordLink;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::middleware(['no-redirect-if-authenticated:admins,web', 'prevent-back-history'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/aboutus', [AboutController::class, 'index'])->name('aboutus');
    Route::middleware(['auth:web'])->group(function () {
        Route::controller(ProfileUserController::class)->group(function () {
            Route::get('/profile', 'index')->name('user-profile.index');
            Route::put('/profile/{user}', 'update')->name('user-profile.update');
        });

        Route::controller(PembayaranUserController::class)->group(function () {
            Route::get('/pembayaran', 'index')->name('user-pembayaran.index');
            Route::post('pembayaran/refresh-token/{id_pesanan}', 'refreshMidtransToken')->name('user-pembayaran.refreshMidtransToken');
            Route::post('pembayaran/{id_order}/cancel', 'cancel')->name('user-pembayaran.cancel');
        });

    });
    Route::resource('/wedding-calculator', CalculatorController::class);
    Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');
    Route::get('/produk/sort/{sort}', [ProdukController::class, 'sortProducts'])->name('produk.sort');
    Route::resource('/produk', ProdukController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/foto', [FotoController::class, 'index'])->name('foto');
    Route::get('/vidio', [VideoController::class, 'index'])->name('vidio');
    Route::get('/email', function () {
        $token = Str::random(60);
        $user = new \App\Models\User(); // Ganti dengan model pengguna yang sesuai
        $user->email = 'test@example.com'; // Ganti dengan alamat email pengguna yang sesuai
        $notification = new SendResetPasswordLink($token);
        $message = $notification->toMail($user);

        return $message->render();
    });

    // Route::get('test', function () {
    //     $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HAS_LENGTH')); // Sesuaikan dengan panjang hash yang Anda gunakan
    //     // $ids = $hashids->decode('jR');
    //     // // Ambil ID aslinya
    //     // $id = $ids[0];

    //     $data = ManagePesanan::where('order_id', 'c0a2424d-06d1-4e5f-8985-ca692de1dc37')->first();
    //     $decode = json_decode($data, true); // untuk menghasilkan array assosiatif
    //     $decode['id_hash_format'] = $data->id_hash_format;

    //     // $admins = Admin::get();
    //     // Notification::send($admins, new PembayaranNotification($data));

    //     return $decode;
    // });
});

/** Awal kode untuk rute super_admin & admin**/
Route::middleware(['auth:admins', 'prevent-back-history'])->group(function () {
    Route::middleware(['role:super_admin,admin'])->group(function () {
        Route::get('dashboard', [DashboardAdminsController::class, 'index'])->name('dashboard');
        Route::controller(ManageAdminController::class)->group(function () {
            Route::get('manage-admin', 'index')->name('manage-admin.index');
            Route::post('manage-admin', 'store')->name('manage-admin.store');
            Route::put('manage-admin/{manage-admin}', 'update')->name('manage-admin.update');
            Route::put('manage-admin/{manage-admin}/edit', 'edit')->name('manage-admin.edit');
            Route::delete('manage-admin/{manage-admin}', 'destroy')->name('manage-admin.destroy');
            Route::delete('manage-admin/user/{id_user}', 'destroyUser')->name('manage-admin.destroyUser');
            Route::get('manage-admin/render-tb-admins', 'renderDataTableAdmins')->name('manage-admin.renderDataTableAdmins');
            Route::get('manage-admin/render-tb-users', 'renderDataTableUsers')->name('manage-admin.renderDataTableUsers');
        });
        Route::controller(ManagePerusahaanController::class)->group(function () {
            Route::get('manage-perusahaan', 'index')->name('manage-perusahaan.index');
            Route::post('manage-perusahaan/updateorcreatecompany', 'updateorcreatecompany')->name('manage-perusahaan.updateorcreatecompany');
            Route::delete('manage-perusahaan/deletecompany/{id}', 'deletecompany')->name('manage-perusahaan.deletecompany');
            Route::post('manage-perusahaan/updateorcreateowner', 'updateorcreateowner')->name('manage-perusahaan.updateorcreateowner');
            Route::delete('manage-perusahaan/deleteowner/{id}', 'deleteowner')->name('manage-perusahaan.deleteowner');
            Route::post('manage-perusahaan/updateorcreateaddress', 'updateorcreateaddress')->name('manage-perusahaan.updateorcreateaddress');
            Route::delete('manage-perusahaan/deleteaddress/{id}', 'deleteaddress')->name('manage-perusahaan.deleteaddress');
            Route::post('manage-perusahaan/updateorcreatevisimisi', 'updateorcreatevisimisi')->name('manage-perusahaan.updateorcreatevisimisi');
            Route::delete('manage-perusahaan/deletevisimisi/{id}', 'deletevisimisi')->name('manage-perusahaan.deletevisimisi');
            Route::post('manage-perusahaan/updateorcreatesosmed', 'updateorcreatesosmed')->name('manage-perusahaan.updateorcreatesosmed');
            Route::delete('manage-perusahaan/deletesosmed/{id}', 'deletesosmed')->name('manage-perusahaan.deletesosmed');
            Route::post('manage-perusahaan/updateorcreatecontact', 'updateorcreatecontact')->name('manage-perusahaan.updateorcreatecontact');
            Route::delete('manage-perusahaan/deletecontact/{id}', 'deletecontact')->name('manage-perusahaan.deletecontact');
            Route::post('manage-perusahaan/updateorcreateabout', 'updateorcreateabout')->name('manage-perusahaan.updateorcreateabout');
            Route::delete('manage-perusahaan/deleteabout/{id}', 'deleteabout')->name('manage-perusahaan.deleteabout');
            Route::post('manage-perusahaan/updateorcreateoffer', 'updateorcreateoffer')->name('manage-perusahaan.updateorcreateoffer');
            Route::delete('manage-perusahaan/deleteoffer/{id}', 'deleteoffer')->name('manage-perusahaan.deleteoffer');
            Route::post('manage-perusahaan/updateorcreatecertificate', 'updateorcreatecertificate')->name('manage-perusahaan.updateorcreatecertificate');
            Route::delete('manage-perusahaan/deletecertificate/{id}', 'deletecertificate')->name('manage-perusahaan.deletecertificate');
            Route::post('manage-perusahaan/updateorcreatevideopromosi', 'updateorcreatevideopromosi')->name('manage-perusahaan.updateorcreatevideopromosi');
            Route::delete('manage-perusahaan/deletevideopromosi/{id}', 'deletevideopromosi')->name('manage-perusahaan.deletevideopromosi');
            Route::post('manage-perusahaan/updateorcreatejo', 'updateorcreatejo')->name('manage-perusahaan.updateorcreatejo');
        });
        Route::controller(ManageProdukController::class)->group(function () {
            Route::get('manage-produk', 'index')->name('manage-produk.index');
            Route::post('manage-produk', 'store')->name('manage-produk.store');
            Route::put('manage-produk/{id}', 'update')->name('manage-produk.update');
            Route::delete('manage-produk/{id}', 'destroy')->name('manage-produk.destroy');
            Route::post('manage-produk/kategori', 'createcategory')->name('manage-produk.createcategory');
            Route::delete('manage-produk/kategori/{id}', 'destroycategory')->name('manage-produk.destroycategory');
        });
        Route::resource('manage-jadwal', ManageJadwalController::class)->except(['create', 'show', 'edit']);
        Route::controller(ManagePesananProsesController::class)->group(function () {
            Route::get('manage-pesanan-proses', 'index')->name('manage-pesanan-proses.index');
            Route::post('manage-pesanan-proses/create', 'create')->name('manage-pesanan-proses.create');
            Route::put('manage-pesanan-proses/{id}', 'update')->name('manage-pesanan-proses.update');
            Route::delete('manage-pesanan-proses/{order_id}', 'destroy')->name('manage-pesanan-proses.destroy');
            Route::put('manage-pesanan-proses/konfirmasi/{data}', 'konfirmasi')->name('manage-pesanan-proses.konfirmasi');
            Route::get('manage-pesanan-proses/detail-pesanan/{id_detail_pesanan}', 'detail')->name('manage-pesanan-proses.detail');
        });
        Route::controller(ManagePesananSelesaiController::class)->group(function () {
            Route::get('manage-pesanan-selesai', 'index')->name('manage-pesanan-selesai.index');
            Route::get('manage-pesanan-selesai/detail-pesanan/{id_detail_pesanan}', 'detail')->name('manage-pesanan-selesai.detail');
            Route::delete('manage-pesanan-selesai/{order_id}', 'destroy')->name('manage-pesanan-selesai.destroy');
        });
        Route::controller(ManageGalleryController::class)->group(function () {
            Route::get('manage-gallery', 'index')->name('manage-gallery.index');
            Route::get('manage-gallery/photo-tab', 'phototab')->name('manage-gallery.phototab');
            Route::get('manage-gallery/video-tab', 'videotab')->name('manage-gallery.videotab');
            Route::post('manage-gallery/photo-tab', 'createphoto')->name('manage-gallery.createphoto');
            Route::delete('manage-gallery/photo-tab/{id}', 'destroyphoto')->name('manage-gallery.destroyphoto');
            Route::post('manage-gallery/video-tab', 'createvideo')->name('manage-gallery.createvideo');
            Route::delete('manage-gallery/video-tab/{id}', 'destroyvideo')->name('manage-gallery.destroyvideo');
        });
        Route::resource('manage-layanan', ManageLayananController::class)->except(['create', 'show', 'edit']);
        Route::controller(ManagePegawaiController::class)->group(function () {
            Route::get('manage-pegawai', 'index')->name('manage-pegawai.index');
            Route::post('manage-pegawai', 'store')->name('manage-pegawai.store');
            Route::put('manage-pegawai/{id}', 'update')->name('manage-pegawai.update');
            Route::delete('manage-pegawai/{id}', 'destroy')->name('manage-pegawai.destroy');
            Route::post('manage-pegawai/jabatan', 'createjabatan')->name('manage-pegawai.createjabatan');
            Route::delete('manage-pegawai/jabatan/{id}', 'destroyjabatan')->name('manage-pegawai.destroyjabatan');
        });
        Route::controller(ManageGudangController::class)->group(function () {
            Route::get('manage-gudang', 'index')->name('manage-gudang.index');
            Route::post('manage-gudang', 'store')->name('manage-gudang.store');
            Route::put('manage-gudang/{id}', 'update')->name('manage-gudang.update');
            Route::delete('manage-gudang/{id}', 'destroy')->name('manage-gudang.destroy');
            Route::post('manage-gudang/kategori', 'createcategorybarang')->name('manage-gudang.createcategorybarang');
            Route::delete('manage-gudang/kategori/{id}', 'destroycategorybarang')->name('manage-gudang.destroycategorybarang');
        });
        Route::controller(ProfileAdminController::class)->group(function () {
            Route::get('profile-admin', 'index')->name('profile-admin');
            Route::post('profile-admin', 'savedata')->name('profile-admin.save');
            Route::post('profile-admin/new-password', 'newpassword')->name('profile-admin.new-password');
        });
        Route::controller(ManageWeddingCalculatorController::class)->group(function () {
            # Rute root
            Route::get('manage-wedding-calculator', 'index')->name('manage-wedding-calculator.index');
            # Rute get data untuk DataTables
            Route::get('manage-wedding-calculator/get-all-in', 'getAllIn')->name('manage-wedding-calculator.getAllIn');
            Route::get('manage-wedding-calculator/get-custom-venue', 'getCustomVenue')->name('manage-wedding-calculator.getCustomVenue');
            Route::get('manage-wedding-calculator/get-additional-venue', 'getAdditionalVenue')->name('manage-wedding-calculator.getAdditionalVenue');
            # Rute create paket all-in, custom venue, additional venue
            Route::post('manage-wedding-calculator/cat-all-in', 'catAllIn')->name('manage-wedding-calculator.catAllIn');
            Route::post('manage-wedding-calculator/cat-custom-venue', 'catCustomVenue')->name('manage-wedding-calculator.catCustomVenue');
            Route::post('manage-wedding-calculator/cat-additional-venue', 'catAdditionalVenue')->name('manage-wedding-calculator.catAdditionalVenue');
            # Rute update paket
            Route::put('manage-wedding-calculator/uat-all-in/{id}', 'uatAllIn')->name('manage-wedding-calculator.uatAllIn');
            Route::put('manage-wedding-calculator/uat-custom-venue/{id}', 'uatCustomVenue')->name('manage-wedding-calculator.uatCustomVenue');
            Route::put('manage-wedding-calculator/uat-additional-venue/{id}', 'uatAdditionalVenue')->name('manage-wedding-calculator.uatAdditionalVenue');
            # Rute delete paket
            Route::delete('manage-wedding-calculator/del-all-in/{id}', 'dAllIn')->name('manage-wedding-calculator.dAllIn');
            Route::delete('manage-wedding-calculator/del-custom-venue/{id}', 'dCustomVenue')->name('manage-wedding-calculator.dCustomVenue');
            Route::delete('manage-wedding-calculator/del-additional-venue/{id}', 'dAdditionalVenue')->name('manage-wedding-calculator.dAdditionalVenue');

            # Rute kategori custom venue dan additional venue
            Route::get('manage-wedding-calculator/data-category-custom-venue', 'dataCategoryCustomVenue')->name('manage-wedding-calculator.dataCategoryCustomVenue');
            Route::get('manage-wedding-calculator/data-category-additional-venue', 'dataCategoryAdditionalVenue')->name('manage-wedding-calculator.dataCategoryAdditionalVenue');

            Route::get('manage-wedding-calculator/get-category-custom-venue', 'getCategoryCustomVenue')->name('manage-wedding-calculator.getCategoryCustomVenue');
            Route::get('manage-wedding-calculator/get-category-additional-venue', 'getCategoryAdditionalVenue')->name('manage-wedding-calculator.getCategoryAdditionalVenue');

            Route::post('manage-wedding-calculator/cat-category-custom-venue', 'catCategoryCustomVenue')->name('manage-wedding-calculator.catCategoryCustomVenue');
            Route::post('manage-wedding-calculator/cat-category-additional-venue', 'catCategoryAdditionalVenue')->name('manage-wedding-calculator.catCategoryAdditionalVenue');
            Route::delete('manage-wedding-calculator/del-category-custom-venue/{id}', 'delCategoryCustomVenue')->name('manage-wedding-calculator.delCategoryCustomVenue');
            Route::delete('manage-wedding-calculator/del-category-additional-venue/{id}', 'delCategoryAdditionalVenue')->name('manage-wedding-calculator.delCategoryAdditionalVenue');

        });
        Route::get('/cetak-kontrak', function () {
            return view('admin.CetakKontrak');
        });
        Route::get('/daftar-notifikasi', function () {
            return view('admin.DaftarNotifikasi');
        });
    });
});
/** Akhir kode **/

Route::fallback(function () {
    // Logika untuk menangani NotFoundHttpException
    abort(404); // Not Found
});

require __DIR__ . '/auth.php';
