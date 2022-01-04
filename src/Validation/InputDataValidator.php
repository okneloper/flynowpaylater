<?php

namespace App\Validation;

/**
 * Input data validator. Extracted into its own class to be able to test the input
 */
class InputDataValidator
{
    public function isValid(string $data): bool
    {
        // contents contain lower case alphabet ASCII letters, punctuations and symbols only
        $letters = 'a-z';
        $punctuation = '.?!,:;-()';
        $symbols = '@#$%*"\'[]^~|`=+/%<>_{}&\\';
        $all = preg_quote("$punctuation$symbols", '#');

        $match = preg_match("#^[$letters$all]+$#D", $data);

        return $match === 1;
    }
}
