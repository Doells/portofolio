<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NimRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Implement logic untuk memeriksa validitas NIM di sini.
        // Misalnya, Anda dapat memeriksa apakah NIM telah digunakan sebelumnya.
        // Jika NIM valid, kembalikan true, jika tidak, kembalikan false.
        // Contoh sederhana:
        return preg_match('/^[0-9]{8}$/', $value);
    }

    public function message()
    {
        return 'NIM tidak valid';
    }
}
