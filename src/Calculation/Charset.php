<?php

namespace App\Calculation;

interface Charset
{
    /**
     * Adds a character to the result
     * @param string $char
     */
    public function addChar(string $char): void;

    /**
     * List added character by number of occurences
     * @return array
     */
    public function listChars(): array;

    /**
     * Returns name (singular form) of the charset
     * @return string
     */
    public function getName(): string;
}
