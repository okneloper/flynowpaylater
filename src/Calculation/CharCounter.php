<?php

namespace App\Calculation;

use App\Calculation\Exceptions\InvalidCharacter;

class CharCounter
{
    /**
     * @var Charset[]
     */
    protected array $charsets;

    /**
     * Adds a charset
     * @param Charset $charset
     */
    public function addCharset(Charset $charset)
    {
        $this->charsets[] = $charset;
    }

    /**
     * @return Charset[]
     */
    public function getCharsets(): array
    {
        return $this->charsets;
    }

    /**
     * Adds a character
     * @param string $char
     */
    public function addChar(string $char)
    {
        if (strlen($char) !== 1) {
            throw new \BadMethodCallException("Unexpected character length");
        }

        foreach ($this->charsets as $charset) {
            try {
                // add char
                $charset->addChar($char);
                // and go to the next character
                break;
            } catch (InvalidCharacter $exception) {
                // continue to the next Charset
                continue;
            }
        }
    }
}
