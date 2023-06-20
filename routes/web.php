<?php

use App\Http\Controllers\admin\DashboardAdminsController;
use App\Http\Controllers\admin\ManageAkunController;
use App\Http\Controllers\admin\ManageGalleryController;
use App\Http\Controllers\admin\ManageGudangController;
use App\Http\Controllers\admin\ManageJadwalController;
use App\Http\Controllers\admin\ManageLayananController;
use App\Http\Controllers\admin\ManagePegawaiController;
use App\Http\Controllers\admin\ManagePerusahaanController;
use App\Http\Controllers\admin\ManagePesananProsesController;
use App\Http\Controllers\admin\ManageProdukController;
use App\Http\Controllers\admin\ProfileAdminController;
use App\Http\Controllers\user\AboutController;
use App\Http\Controllers\user\CalculatorController;
use App\Http\Controllers\user\FotoController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\ProdukController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\VideoController;
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

Route::get('/produk/sort/{sort}', [ProdukController::class, 'sortProducts'])->name('produk.sort');

// Route untuk search produk
Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');

Route::get('/cetak-kontrak', function () {
    return view('user.CetakKontrak');
});

Route::get('/cetak-struk', function () {
    return view('user.struk');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/profile', 'index')->name('user-profile.index');
    // Rute untuk pembaruan data pengguna
    Route::put('/profile/user/update', 'update')->name('user.profile');
});

Route::middleware(['no-redirect-if-authenticated:admins,web', 'prevent-back-history'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/aboutus', [AboutController::class, 'index'])->name('aboutus');
    Route::get('/maintenance', function () {
        return view('user.maintenance');
    });
    Route::get('/pembayaran', function () {
        return view('user.pembayaran');
    });
    Route::resource('/wedding-calculator', CalculatorController::class);
    Route::resource('/produk', ProdukController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/foto', [FotoController::class, 'index'])->name('foto');
    Route::get('/vidio', [VideoController::class, 'index'])->name('vidio');

    Route::get('/email', function () {
        $token = Str::random(60);
        $user = new \App\Models\User (); // Ganti dengan model pengguna yang sesuai
        $user->email = 'test@example.com'; // Ganti dengan alamat email pengguna yang sesuai
        $notification = new SendResetPasswordLink($token);
        $message = $notification->toMail($user);

        return $message->render();
    });
});

/** Awal kode untuk rute super_admin & admin**/
Route::middleware(['auth:admins', 'prevent-back-history'])->group(function () {
    Route::middleware(['role:super_admin,admin'])->group(function () {
        Route::get('dashboard', [DashboardAdminsController::class, 'index'])->name('dashboard');
        Route::resource('manage-akun', ManageAkunController::class)->except('create'); // Pakai Policy
        Route::controller(ManagePerusahaanController::class)->group(function () {
            Route::get('manage-perusahaan', 'index')->name('manage-perusahaan.index');
            Route::post('manage-perusahaan/updateorcreatecompany', 'updateorcreatecompany')->name('manage-perusahaan.updateorcreatecompany');
            Route::delete('manage-perusahaan/deletecompany/{id}', 'deletecompany')->name('manage-perusahaan.deletecompany');
            Route::post('manage-perusahaan/updateorcreateowner', 'updateorcreateowner')->name('manage-perusahaan.updateorcreateowner');
            Route::delete('manage-perusahaan/deleteowner/{id}', 'deleteowner')->name('manage-perusahaan.deleteowner');
            Route::post('manage-perusahaan/updateorcreateaddress', 'updateorcreateaddress')->name('manage-perusahaan.updateorcreateaddress');
            Route::delete('manage-perusahaan/deleteaddress/{id}', 'deleteaddress')->name('manage-perusahaan.deleteaddress');
            Route::post('manage-perusahaan/updateorcreatesosmed', 'updateorcreatesosmed')->name('manage-perusahaan.updateorcreatesosmed');
            Route::delete('manage-perusahaan/deletesosmed/{id}', 'deletesosmed')->name('manage-perusahaan.deletesosmed');
            Route::post('manage-perusahaan/updateorcreatecontact', 'updateorcreatecontact')->name('manage-perusahaan.updateorcreatecontact');
            Route::delete('manage-perusahaan/deletecontact/{id}', 'deletecontact')->name('manage-perusahaan.deletecontact');
            Route::post('manage-perusahaan/updateorcreateabout', 'updateorcreateabout')->name('manage-perusahaan.updateorcreateabout');
            Route::delete('manage-perusahaan/deleteabout/{id}', 'deleteabout')->name('manage-perusahaan.deleteabout');
            Route::post('manage-perusahaan/updateorcreateoffer', 'updateorcreateoffer')->name('manage-perusahaan.updateorcreateoffer');
            Route::delete('manage-perusahaan/deleteoffer/{id}', 'deleteoffer')->name('manage-perusahaan.deleteoffer');
            Route::post('manage-perusahaan/addvideopromosi', 'updateorcreatevideopromosi')->name('manage-perusahaan.updateorcreatevideopromosi');
            Route::delete('manage-perusahaan/addvideopromosi/{id}', 'deletevideopromosi')->name('manage-perusahaan.deletevideopromosi');
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
        Route::resource('manage-jadwal', ManageJadwalController::class);
        Route::controller(ManagePesananProsesController::class)->group(function () {
            Route::get('manage-pesanan-proses', 'index')->name('manage-pesanan-proses.index');
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
        Route::get('/weddingcalculator', function () {
            return view('admin.ManageWeddingCal');
        });
    });
});
/** Akhir kode **/

require __DIR__ . '/auth.php';
