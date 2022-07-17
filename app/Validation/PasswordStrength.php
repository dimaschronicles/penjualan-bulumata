<?php

namespace App\Validation;

class PasswordStrength
{
    public $length = 7;

    public $lengthCheck = false;

    public $uppercaseCheck = false;

    public $numericCheck = false;

    public $specialCharacterCheck = false;

    public function password_strength(string $str, string $length, array $data, string &$error = null)
    {
        $this->lengthCheck = strlen($str) >= $this->length;
        $this->numericCheck = (bool) preg_match('/[0-9]/', $str);
        if ($this->lengthCheck && $this->numericCheck) {
            return true;
        }
        //pesan jika gagal validasi
        $error = "Password minimal {$length} karakter dan mengandung huruf dan angka!";
        return false;
    }
}
