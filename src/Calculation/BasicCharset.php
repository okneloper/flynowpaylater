<?php

namespace App\Calculation;

use App\Calculation\Exceptions\InvalidCharacter;

class BasicCharset implements Charset
{
    protected string $valid_chars;

    protected array $chars = [];

    protected string $name;

    /**
     * @param string $valid_chars
     */
    public function __construct(string $valid_chars, string $name)
    {
        $this->valid_chars = $valid_chars;
        $this->name = $name;
    }

    public function addChar(string $char): void
    {
        // ignore invalid characters
        if (strpos($this->valid_chars, $char) === false) {
            throw new InvalidCharacter("Invalid char: $char");
        }

        if (!isset($this->chars[$char])) {
            $this->chars[$char] = 0;
        }
        $this->chars[$char]++;
    }

    public function listChars(): array
    {
        return $this->chars;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
