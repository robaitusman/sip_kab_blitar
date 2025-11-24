<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    public function passes($attribute, $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $lengthOk = strlen($value) >= 12;
        $hasUpper = preg_match('/[A-Z]/', $value);
        $hasLower = preg_match('/[a-z]/', $value);
        $hasNumber = preg_match('/[0-9]/', $value);
        $hasSymbol = preg_match('/[^A-Za-z0-9]/', $value);
        $noRepeat = !preg_match('/(.)\\1{2,}/', $value); // three identical chars in a row

        return $lengthOk && $hasUpper && $hasLower && $hasNumber && $hasSymbol && $noRepeat;
    }

    public function message(): string
    {
        return 'Password minimal 12 karakter, mengandung huruf besar, huruf kecil, angka, simbol, dan tidak boleh ada karakter yang diulang lebih dari 3 kali.';
    }
}
