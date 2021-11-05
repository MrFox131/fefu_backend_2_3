<?php

namespace App\Sanitizers;

class DigitOnlySanitizer
{
    public static function sanitize(string $value) : string {
        $value = preg_replace('/\D+/', '', $value);
        if ($value[0] == '8') {
            $value[0] = '7';
        }
        return $value;
    }
}
