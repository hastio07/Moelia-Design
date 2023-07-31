<?php

namespace App\Providers;

use App\Models\ManagePesanan;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    // public const HOME = '/home';
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        $this->configureModelBindingHashIds();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for ('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        // RateLimiter::for ('login', function (Request $request) {
        //     $key = $request->input('email');
        //     $max = 5;
        //     $delay = 60;
        //     if (RateLimiter::tooManyAttempts($key, $max)) {
        //         return back()->with('message', 'Too Many Request.');

        //     } else {
        //         RateLimiter::hit($key, $delay);
        //     }

        // });
        // RateLimiter::for ('login', function (Request $request) {
        //     $key = 'login.' . $request->ip();
        //     $max = 5;
        //     $delay = 60;
        //     if (RateLimiter::tooManyAttempts($key, $max)) {
        //         return back()->with('message', 'Too Many Request.');

        //     } else {
        //         RateLimiter::hit($key, $delay);
        //     }
        // });
    }
    protected function configureModelBindingHashIds()
    {
        // Model binding untuk User berdasarkan hash
        Route::bind('id_user', function ($value) {
            // Ubah kembali hash menjadi ID aslinya menggunakan Hashids
            $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HAS_LENGTH')); // Sesuaikan dengan panjang hash yang Anda gunakan
            $ids = $hashids->decode($value);

            // Jika hash tidak valid atau tidak dapat di-decode, lempar exception 404
            if (empty($ids)) {
                abort(404);
            }

            // Ambil ID aslinya
            $id = $ids[0];

            // Cari data User berdasarkan ID
            return User::findOrFail($id);
        });

        Route::bind('id_pesanan', function ($value) {
            // Ubah kembali hash menjadi ID aslinya menggunakan Hashids
            $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HAS_LENGTH')); // Sesuaikan dengan panjang hash yang Anda gunakan
            $ids = $hashids->decode($value);

            // Jika hash tidak valid atau tidak dapat di-decode, lempar exception 404
            if (empty($ids)) {
                abort(404);
            }

            // Ambil ID aslinya
            $id = $ids[0];

            // Cari data User berdasarkan ID
            return ManagePesanan::findOrFail($id);
        });

        Route::bind('id_detail_pesanan', function ($value) {
            // Ubah kembali hash menjadi ID aslinya menggunakan Hashids
            $hashids = new Hashids(env('HASHIDS_KEY'), env('HASHIDS_HAS_LENGTH')); // Sesuaikan dengan panjang hash yang Anda gunakan
            $ids = $hashids->decode($value);

            // Jika hash tidak valid atau tidak dapat di-decode, lempar exception 404
            if (empty($ids)) {
                abort(404);
            }

            // Ambil ID aslinya
            $id = $ids[0];

            // Cari data User berdasarkan ID
            return ManagePesanan::findOrFail($id);
        });

    }
}
