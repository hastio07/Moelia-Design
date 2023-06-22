<?php

namespace App\Rules;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniqueEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Cek keberadaan email di tabel admins
        $admin = Admin::where('email', $value)->first();

        if ($admin) {
            return false; // Email sudah ada di tabel admins
        }

// Cek keberadaan email di tabel users
        $user = User::where('email', $value)->first();

        if ($user) {
            return false; // Email sudah ada di tabel users
        }

        return true; // Email tersedia untuk digunakan

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email sudah digunakan.';
    }
}
