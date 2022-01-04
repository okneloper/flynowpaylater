<?php

namespace App\Validation;

class InputFormatValidator
{
    public function isValid(?string $format): bool
    {
        $valid_formats = [
            'non-repeating',
            'least-repeating',
            'most-repeating',
        ];
        return !empty($format) && in_array($format, $valid_formats);
    }
}
