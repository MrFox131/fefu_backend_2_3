<?php

namespace App\Sanitizers;

class PhoneNumberSanitizer
{
    public static function sanitize(string $value) : string {
        $value = preg_replace('/\D+/', '', $value);
        $value[0] = '7';
        return $value;
    }
}
