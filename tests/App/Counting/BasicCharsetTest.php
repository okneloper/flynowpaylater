<?php

namespace App\Calculation;

use App\Calculation\Exceptions\InvalidCharacter;
use PHPUnit\Framework\TestCase;

class BasicCharsetTest extends TestCase
{
    public function testAddsLetters(): void
    {
        $factory = new Charsets();

        $letters = $factory->makeLetters();
        $letters->addChar('a');
        $letters->addChar('A');
        $letters->addChar('A');

        $this->assertEquals(['a' => 1, 'A' => 2], $letters->listChars());
    }

    public function testFailsWithInvalidCharacter(): void
    {
        $factory = new Charsets();

        $letters = $factory->makeLetters();

        $this->expectException(InvalidCharacter::class);

        $letters->addChar('*');
    }
}
