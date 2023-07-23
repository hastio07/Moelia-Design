<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class CekEmailUser implements Rule
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
        // Cek keberadaan email di tabel users
        $user = User::where('email', $value)->first();

        if ($user) {
            return true; // Email tersedia untuk digunakan
        }
        return false; // Email tidak ada di tabel users
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email tidak tercatat di sistem kami.';
    }
}
