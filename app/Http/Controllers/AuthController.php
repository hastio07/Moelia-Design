<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        return view('authenticate.login');
    }

    /**
     * Memproses permintaan login
     */
    public function authenticate(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:5'],
        ];
        $massages = [
            'email' => ':attribute harus berupa alamat surel yang valid.',
            'min' => ':attribute harus diisi minimal :min karakter.',
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa string/teks.',
        ];
        $customAttributes = [
            'email' => 'E-mail',
            'password' => 'Kata sandi',
        ];
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $validator->validated();
        $guardAdmin = Auth::guard('admins')->attempt($credentials);
        $guardUser = Auth::guard('web')->attempt($credentials);

        // Memeriksa apakah data yang diberikan valid.
        if ($guardAdmin || $guardUser) {
            if (Auth::guard('admins')->check()) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } else {
            $key = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

            // Memeriksa jumlah percobaan yang dilakukan.
            $maxAttemps = 3;
            if (RateLimiter::tooManyAttempts($key, $maxAttemps)) {
                event(new Lockout($request));

                $seconds = RateLimiter::availableIn($key);

                throw ValidationException::withMessages([
                    'status' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $seconds . ' detik.',
                ]);
            }
            // Menambah hitungan percobaan yang dilakukan.
            RateLimiter::hit($key);

            $existingAdmin = Admin::where('email', $credentials['email'])->first();
            $existingUser = User::where('email', $credentials['email'])->first();

            $model = $existingAdmin ?: $existingUser;

            // Jika kedua pengguna tidak ada
            if (!$model) {
                return back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
            }
            // Memeriksa apakah password yang diberikan valid
            if ($model && !Hash::check($credentials['password'], $model->password)) {
                return back()->withErrors(['password' => 'Password yang diberikan salah.'])->withInput();
            }

            return back()->with('failed', 'Login gagal!')->withErrors(['status' => 'Kredensial ini tidak cocok dengan catatan kami.'])->withInput();
        }
    }
    /**
     * Memproses permintaan logout
     */
    public function destroy(Request $request)
    {
        // Mendapatkan Guard Saat ini
        $getCurrentGuard = Auth::getDefaultDriver();
        Auth::guard($getCurrentGuard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Menampilkan halaman register users
     */
    public function create()
    {
        return view('authenticate.register');
    }
    /**
     * Memproses permintaan register users
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'phone' => 'required|numeric|max:99999999999999|regex:/^(?:\+62)?\d{9,12}$/',
            'password' => ['required', 'min:5', 'max:255', 'confirmed', RulesPassword::min(5)->letters()->mixedCase()->symbols()],
        ];
        $massages = [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute harus diisi maksimal :max karakter.',
            'confirmed' => 'konfirmasi :attribute tidak cocok.',
            'email' => ':attribute harus berupa alamat surel yang valid.',
            'numeric' => ':attribute harus dalam format numerik.',
            'password.min' => ':attribute harus terdiri dari minimal :min karakter.',
        ];
        $customAttributes = [
            'nama_depan' => 'Nama Depan',
            'nama_belakang' => 'Nama Belakang',
            'email' => 'E-mail',
            'phone' => 'Telepon',
            'password' => 'Kata sandi',
        ];
        $validator = Validator::make($request->all(), $rules, $massages, $customAttributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validatedData = $validator->validated();
        $validatedData['role_id'] = 3;
        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Menampilkan halaman forgot password users dan admins
     */
    public function forgotpassword()
    {
        return view('authenticate.forgot-password');
    }
    /**
     * Memproses permintaan forgot password users dan admins
     */
    public function sendresetlinkforgotpassword(Request $request)
    {

        $rules = [
            'email' => ['required', 'email', function ($attribute, $value, $fail) {
                if (!(User::where('email', $value)->exists() || Admin::where('email', $value)->exists())) {
                    $fail(':attribute tidak ditemukan.');
                }
            }],
        ];
        $customAttributes = [
            'email' => 'E-mail',
        ];

        $validator = Validator::make($request->only('email'), $rules, [], $customAttributes);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $validator->validated()['email'];

        $admin = Admin::where('email', $email)->first();
        if ($admin) {
            $broker = 'admins';
        } else {
            $broker = 'users';
        }

        $status = Password::broker($broker)->sendResetLink(
            ['email' => $email]
        );

        return $status == Password::RESET_LINK_SENT
        ? back()->with('status', trans($status))
        : back()->withErrors(['email' => trans($status)])->withInput($request->only('email'));
    }

    /**
     * Menampilkan halaman reset password users dan admins
     */
    public function passwordreset(Request $request)
    {
        // Jika tidak ada token
        if (!$request->route('token')) {
            return redirect()->route('login');
        }

        return view('authenticate.reset-password', ['request' => $request]);
    }
    /**
     * Memproses permintaan reset password users dan admins
     */
    public function passwordupdate(Request $request)
    {

        $rules = [
            'email' => ['required', 'string', 'email', function ($attribute, $value, $fail) {
                if (!(User::where('email', $value)->exists() || Admin::where('email', $value)->exists())) {
                    $fail(':attribute tidak ditemukan.');
                }
            }],
            'password' => ['required', 'min:5', 'max:255', 'confirmed', RulesPassword::min(5)->letters()->mixedCase()->symbols()],
        ];
        $customAttributes = [
            'email' => 'E-mail',
            'password' => 'Kata sandi',
        ];
        $validator = Validator::make($request->all(), $rules, [], $customAttributes);

        // Jika gagal validasi
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Ambil nilai email yang sudah divalidasi
        $email = $validator->validated()['email'];

        // Tentukan broker berdasarkan alamat email
        // Cek apakah alamat email termasuk dalam model Admin
        $admin = Admin::where('email', $email)->first();
        if ($admin) {
            $broker = 'admins';
        } else {
            $broker = 'users';
        }

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // Jika sukses maka status isinya password.reset
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }
        // Jika gagal maka status isinya password.user
        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
