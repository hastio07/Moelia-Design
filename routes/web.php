<?php

use App\Http\Controllers\DashboardAdminsController;
use App\Http\Controllers\ManageAkunController;
use App\Http\Controllers\ManageGalleryController;
use App\Http\Controllers\ManageLayananController;
use App\Http\Controllers\ManagePerusahaanController;
use App\Http\Controllers\ManageProdukController;
use App\Http\Controllers\user\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware(['guest:admins', 'prevent-back-history']);

Route::get('/aboutus', function () {
    return view('dashboard.user.aboutus');
})->middleware(['guest:admins', 'prevent-back-history']);

Route::get('/maintenance', function () {
    return view('dashboard.user.maintenance');
})->middleware(['guest:admins', 'prevent-back-history']);

// Route::get('/maintenance', function () {
//     return view('dashboard.user.maintenance');
// })->middleware(['guest:admins', 'prevent-back-history']);

/** Awal kode untuk rute super_admin & admin**/
Route::middleware(['auth:admins', 'prevent-back-history'])->group(function () {
    Route::get('dashboard', [DashboardAdminsController::class, 'index']);
    Route::middleware(['role:super_admin'])->prefix('dashboard')->group(function () {
        Route::resource('manage-akun', ManageAkunController::class)->except('create');
    });
    Route::middleware(['role:super_admin,admin'])->prefix('dashboard')->group(function () {
        Route::resource('manage-produk', ManageProdukController::class)->except(['create', 'show', 'edit']);
        // Route::resource('manage-gallery', ManageGalleryController::class);
        Route::controller(ManageGalleryController::class)->group(function () {
            Route::get('manage-gallery', 'index')->name('manage-gallery.index');
            Route::get('manage-gallery/photo-tab', 'phototab')->name('manage-gallery.phototab');
            Route::get('manage-gallery/video-tab', 'videotab')->name('manage-gallery.videotab');
            Route::post('manage-gallery/photo-tab', 'createphoto')->name('manage-gallery.createphoto');
            Route::delete('manage-gallery/photo-tab/{id}', 'destroyphoto')->name('manage-gallery.destroyphoto');
            Route::post('manage-gallery/video-tab', 'createvideo')->name('manage-gallery.createvideo');
            Route::delete('manage-gallery/video-tab/{id}', 'destroyvideo')->name('manage-gallery.destroyvideo');
        });
        Route::controller(ManagePerusahaanController::class)->group(function () {
            Route::get('manage-perusahaan', 'index')->name('manage-perusahaan.index');
            Route::post('manage-perusahaan/updateorcreatecompany', 'updateorcreatecompany')->name('manage-perusahaan.updateorcreatecompany');
            Route::delete('manage-perusahaan/deletecompany/{id}', 'deletecompany')->name('manage-perusahaan.deletecompany');
            Route::post('manage-perusahaan/updateorcreateowner', 'updateorcreateowner')->name('manage-perusahaan.updateorcreateowner');
            Route::delete('manage-perusahaan/deleteowner/{id}', 'deleteowner')->name('manage-perusahaan.deleteowner');
            Route::post('manage-perusahaan/updateorcreateaddress', 'updateorcreateaddress')->name('manage-perusahaan.updateorcreateaddress');
            Route::delete('manage-perusahaan/deleteaddress/{id}', 'deleteaddress')->name('manage-perusahaan.deleteaddress');
            Route::post('manage-perusahaan/updateorcreatsosmed', 'updateorcreatsosmed')->name('manage-perusahaan.updateorcreatsosmed');
            Route::delete('manage-perusahaan/deletesosmed/{id}', 'deletesosmed')->name('manage-perusahaan.deletesosmed');
            Route::post('manage-perusahaan/updateorcreatcontact', 'updateorcreatcontact')->name('manage-perusahaan.updateorcreatcontact');
            Route::delete('manage-perusahaan/deletecontact/{id}', 'deletecontact')->name('manage-perusahaan.deletecontact');
        });
        Route::resource('manage-layanan', ManageLayananController::class)->except(['create', 'show', 'edit']);
    });
});
/** Akhir kode **/

require __DIR__ . '/auth.php';
